<?php

namespace App\Http\Controllers\Trooper;

use App\Models\User;
use App\Models\Course;
use App\Models\Competition;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard';
        $courseCount = Course::count();
        $mycourseCount = Competition::where('user_id', Auth::user()->id)->count();
        $mytransactionCount = Transaction::where('user_id', Auth::user()->id)->count();
        return view('troopers.dashboard', compact('title','courseCount','mycourseCount','mytransactionCount'));
    }

    public function myTransactions()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->where('payment_status', 'pending')
            ->get();

        return view('troopers.transactions.my-transactions', compact('transactions'));
    }

    public function deleteTransaction($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        if ($transaction->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this transaction.');
        }

        $transaction->delete();

        return redirect()->route('troopers.my-transactions')->with('success', 'Transaction deleted successfully.');
    }

    public function account()
    {
        $title = 'Pengaturan Akun';
        $user = Auth::user();
        return view('troopers.account-setting', compact('title','user'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
    
        return redirect()->back()->with('success', 'Acount updated successfully.');
    }

    public function updateModal(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
    
        return redirect()->route('troopers.dashboard')->with('success', 'Acount updated successfully.');
    }

}
