<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashBoardController extends Controller
{
    public function index ()
    {
        $user = User::where('id', Auth::user()->id)->with('user_transaction_brief')->first();
        return view('dashboard', compact('user'));
    }
}
