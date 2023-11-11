<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsSlider;
use App\Traits\AlertTrait;
use Illuminate\Http\Request;

class NewsSliderController extends Controller
{
    use AlertTrait;

    public function index()
    {
        $allNews = NewsSlider::orderBy('id', 'desc')->get();
        return view('pages.news_slider.index', compact(['allNews']));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'news' => 'required|min:3|max:100',
            ],
            [
                'news.required' => 'News input field is required',
                'news.min' => 'Minimum 3 letters required',
                'news.max' => 'Maximum 100 letters allowed'
            ]
        );

        $newsCount = NewsSlider::count();
        if ($newsCount > 10) {
            return back()->with($this->warningAlert('You cannot add more than 10 news'));
        }

        $newsSlider = new NewsSlider();
        $newsSlider->news = $request->news;
        $newsSlider->save();

        return back()->with($this->successAlert('Successfully Created!'));
    }

    public function destroy(string $id)
    {
        $newsSlider = NewsSlider::find($id);
        if ($newsSlider) {
            $newsSlider->delete();
            return back()->with($this->successAlert('Successfully Deleted!'));
        }
        return back()->with($this->errorAlert('Item not found!'));
    }
}
