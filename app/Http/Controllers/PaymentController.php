<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Course;
use App\Models\Competition;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserPurchasedNotification;
use App\Notifications\CoursePurchasedNotification;

class PaymentController extends Controller
{
    public function buyCourse(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);

            if (!config('midtrans.server_key')) {
                throw new \Exception('Midtrans Server Key is missing');
            }

            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            $orderId = 'TRX-' . uniqid();

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'order_id' => $orderId,
                'amount' => $course->price,
                'payment_status' => 'pending',
                'status' => 'waiting_payment',
            ]);

            $transactionData = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $course->price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'item_details' => [
                    [
                        'id' => $course->id,
                        'price' => $course->price,
                        'quantity' => 1,
                        'name' => $course->title,
                    ],
                ],
            ];

            $snapToken = Snap::getSnapToken($transactionData);

            return response()->json([
                'snapToken' => $snapToken,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Payment initialization failed',
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        if ($transaction->payment_status === 'paid') {
            return response()->json(['message' => 'Already processed'], 200);
        }

        try {
            switch ($request->transaction_status) {
                case 'settlement':
                    $transaction->update([
                        'payment_status' => 'paid',
                        'status' => 'completed',
                    ]);

                    Competition::firstOrCreate([
                        'user_id' => $transaction->user_id,
                        'course_id' => $transaction->course_id,
                    ]);

                    $admin = (object) [
                        'phone' => env('ADMIN_WHATSAPP_NUMBER'),
                        'name' => 'Admin',
                    ];

                    if ($transaction->user && $transaction->course) {
                        Notification::send(
                            $admin,
                            new CoursePurchasedNotification(
                                $transaction->user,
                                $transaction->course,
                                $transaction
                            )
                        );

                        Notification::send(
                            $admin,
                            new UserPurchasedNotification(
                                $transaction->user,
                                $transaction->course,
                                $transaction
                            )
                        );
                    }

                    break;

                case 'pending':
                    $transaction->update([
                        'payment_status' => 'pending',
                        'status' => 'waiting_payment',
                    ]);
                    break;

                case 'expire':
                case 'cancel':
                case 'failure':
                    $transaction->update([
                        'payment_status' => 'failed',
                        'status' => 'failed',
                    ]);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Callback Error', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Callback error'], 500);
        }

        return response()->json(['message' => 'Callback handled'], 200);
    }
}
