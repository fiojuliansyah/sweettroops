<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\Competition;
use App\Notifications\CoursePurchasedNotification;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

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
    
        if ($hashed == $request->signature_key) {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
    
            if ($transaction) {
                if ($request->transaction_status == 'settlement') {
                    $transaction->payment_status = 'paid';
                    $transaction->status = 'completed';
                    $transaction->save();
    
                    
                    Competition::create([
                        'user_id' => $transaction->user_id,
                        'course_id' => $transaction->course_id,
                    ]);
    
                    
                    $admin = (object) ['phone' => env('ADMIN_WHATSAPP_NUMBER'), 'name' => 'Admin'];
                    Notification::send($admin, new CoursePurchasedNotification($transaction->user, $transaction->course, $transaction));
                } elseif ($request->transaction_status == 'pending') {
                    $transaction->payment_status = 'pending';
                    $transaction->status = 'waiting_payment';
                } elseif ($request->transaction_status == 'expire') {
                    $transaction->payment_status = 'expired';
                    $transaction->status = 'failed';
                } elseif ($request->transaction_status == 'cancel') {
                    $transaction->payment_status = 'canceled';
                    $transaction->status = 'failed';
                } elseif ($request->transaction_status == 'failure') {
                    $transaction->payment_status = 'failed';
                    $transaction->status = 'failed';
                }
    
                $transaction->save();
            }
        }
    }
}