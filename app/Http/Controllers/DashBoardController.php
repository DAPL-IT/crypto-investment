<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BannerSlider;
use App\Models\NewsSlider;

class DashBoardController extends Controller
{
    public function index ()
    {
        $user = User::where('id', Auth::user()->id)->with('user_transaction_brief')->first();
        $banners = BannerSlider::all();
        $newses = NewsSlider::all();

        $allNews = '';
        foreach ($newses as $news) {
            $allNews .= $news->news . ' ' . '|' . ' ';
        }
        return view('dashboard', compact('user', 'banners', 'allNews'));
    }
}
