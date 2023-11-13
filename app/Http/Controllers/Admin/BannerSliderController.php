<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerSlider;
use App\Traits\AlertTrait;
use App\Traits\HelperTrait;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerSliderController extends Controller
{
    use AlertTrait, HelperTrait;

    public function index()
    {
        $allBanners = BannerSlider::orderBy('id', 'desc')->get();
        return view('pages.banner_slider.index', compact(['allBanners']));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'banner' => 'required|image|mimes:png,jpg,jpeg|min:1|max:5121',
            ],
            [
                'banner.required' => 'Banner input field is required',
                'banner.min' => 'Invalid image',
                'banner.max' => 'Maximum 5Mb image size is allowed'
            ]
        );

        $reqFile = $request->file('banner');
        $fileName = pathinfo($reqFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = strtolower($reqFile->getClientOriginalExtension());
        $newFileName = $this->generateFileName($fileName, $fileExtension);
        $fileDir = BannerSlider::BANNER_DIR;

        $banner = new BannerSlider();
        $banner->banner_dir =  $fileDir;
        $banner->file_name = $newFileName;

        try {
            Image::make($reqFile)
                ->resize(900, 450)
                ->encode($fileExtension, 75)
                ->save($fileDir . $newFileName);
        } catch (Exception $e) {
            return back()->with($this->errorAlert('Failed to upload!'));
        }

        $banner->save();
        return back()->with($this->successAlert('Successfully uploaded!'));
    }

    public function destroy(string $id)
    {
        $banner = BannerSlider::find($id);
        if ($banner) {
            if (file_exists($banner->banner_full_path)) {
                unlink($banner->banner_full_path);
            }
            $banner->delete();
            return back()->with($this->successAlert('Successfully Deleted!'));
        }
        return back()->with($this->errorAlert('Item not found!'));
    }
}
