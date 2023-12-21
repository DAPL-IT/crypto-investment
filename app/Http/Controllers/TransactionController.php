<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    
    public function index ()
    {
        $withdraws = Withdraw::where('user_id', Auth::user()->id)->get();
        $deposits = Deposit::where('user_id', Auth::user()->id)->get();
        return view ('pages.transaction.index', compact('withdraws', 'deposits'));
    }
}
