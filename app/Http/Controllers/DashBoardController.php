<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BannerSlider;
use App\Models\NewsSlider;
use App\Models\TaskRecord;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->with('user_transaction_brief')->first();
        $banners = BannerSlider::all();
        $newses = NewsSlider::all();
        $appSetting = AppSetting::orderBy('id', 'desc')->first();

        $allNews = '';
        foreach ($newses as $key => $news) {
            if ($key === $newses->keys()->last()) {
                $allNews .= $news->news;
            } else {
                $allNews .= $news->news . ' ' . '|' . ' ';
            }
        }
        $today = Carbon::now()->startOfDay();
        $taskCount = TaskRecord::where('user_id', Auth::user()->id)->whereDate('created_at', $today)->count();
        $remainingTask = 4-$taskCount;
        return view('dashboard', compact('user', 'banners', 'allNews', 'appSetting', 'remainingTask'));
    }
}
