<?php

namespace App\Http\Controllers\Trooper;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard';
        return view('troopers.dashboard', compact('title'));
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

}
