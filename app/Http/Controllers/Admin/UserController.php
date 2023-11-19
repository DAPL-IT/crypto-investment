<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index ()
    {
        $users = User::where('account_type', 'user')->paginate(10);
        return view('pages.user.index', compact(['users']));
    }
}
