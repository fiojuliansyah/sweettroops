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
                throw new \Exception("Midtrans Server Key is missing! Check .env file.");
            }
    
            
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');
    
            $order_id = 'TRX-' . uniqid();
    
            
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'order_id' => $order_id,
                'amount' => $course->price,
                'payment_status' => 'pending',
            ]);
    
            $transaction_data = [
                'transaction_details' => [
                    'order_id' => $order_id,
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
                        'name' => $course->title
                    ],
                ],
            ];
    
            $snapToken = Snap::getSnapToken($transaction_data);
    
            
            $admin = (object) ['phone' => env('ADMIN_WHATSAPP_NUMBER'), 'name' => 'Admin'];
            Notification::send($admin, new CoursePurchasedNotification(Auth::user(), $course, $transaction));
    
            return response()->json(['snapToken' => $snapToken]);
    
        } catch (\Exception $e) {
            Log::error("Midtrans Error: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed != $request->signature_key) {
            \Log::warning('Signature tidak valid', [
                'expected' => $hashed,
                'actual' => $request->signature_key,
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            \Log::warning('Transaksi tidak ditemukan', ['order_id' => $request->order_id]);
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        try {
            switch ($request->transaction_status) {
                case 'settlement':
                    $transaction->payment_status = 'paid';
                    $transaction->status = 'completed';
                    $transaction->save();

                    Competition::create([
                        'user_id' => $transaction->user_id,
                        'course_id' => $transaction->course_id,
                    ]);

                    $admin = (object) ['phone' => env('ADMIN_WHATSAPP_NUMBER'), 'name' => 'Admin'];

                    if ($transaction->user && $transaction->course) {
                        Notification::send($admin, new CoursePurchasedNotification($transaction->user, $transaction->course, $transaction));
                        Notification::send($admin, new UserPurchasedNotification($transaction->user, $transaction->course, $transaction));
                    } else {
                        \Log::warning('User atau Course null saat kirim notifikasi.');
                    }

                    break;

                case 'pending':
                    $transaction->payment_status = 'pending';
                    $transaction->status = 'waiting_payment';
                    $transaction->save();
                    break;

                case 'expire':
                case 'cancel':
                case 'failure':
                    $transaction->payment_status = 'failed';
                    $transaction->status = 'failed';
                    $transaction->save();
                    break;
            }
        } catch (\Exception $e) {
            \Log::error('Callback error:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Internal server error'], 500);
        }

        return response()->json(['message' => 'Callback handled'], 200);
    }

}