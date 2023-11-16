<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Traits\AlertTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Facades\Image;

class AppSettingController extends Controller
{
    use AlertTrait;

    public function index(Request $request)
    {
        $appSetting = AppSetting::latest()->first();
        if (!$appSetting) {
            $appSetting = new AppSetting();
            $appSetting->save();
            $appSetting = AppSetting::latest()->first();
            $this->setAppNameToJSON($appSetting->app_name);
        }
        return view('pages.app_setting.index', compact(['appSetting']));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'app_name' => 'required|min:3|max:15',
                'logo' => 'nullable|image|mimes:png,jpg,jpeg|min:1|max:129',
                'background' => 'nullable|image|mimes:png,jpg,jpeg|min:1|max:5121',
            ],
            [
                'app_name.required' => 'App Name cannot be empty',
                'app_name.min' => 'App Name must have minimum of 3 letters',
                'app_name.max' => 'App Name should not have more than 15 letters',
                'logo.min' => 'Invalid logo image',
                'logo.max' => 'Logo image cannot be more than 128Kb',
                'logo.min' => 'Invalid background image',
                'logo.max' => 'Background image cannot be more than 5Mb'
            ]
        );

        $appSetting = AppSetting::findOrFail($id);

        $appSetting->app_name = $request->app_name;

        $this->setAppNameToJSON($request->app_name);

        if ($request->hasFile('icon')) {
            if ($appSetting->icon_file_name && file_exists($appSetting->icon_full_path)) {
                unlink($appSetting->icon_full_path);
            }
            $reqFile = $request->file('icon');
            $fileName = 'icon';
            $fileExtension = strtolower($reqFile->getClientOriginalExtension());
            $newFileName = $fileName . '.' . $fileExtension;
            $fileDir = AppSetting::ICON_DIR;
            try {
                Image::make($reqFile)
                    ->resize(64, 64)
                    ->save($fileDir . $newFileName);
            } catch (Exception $e) {
                return back()->with($this->errorAlert('Failed to upload!'));
            }

            $appSetting->icon_dir = $fileDir;
            $appSetting->icon_file_name = $newFileName;
        }

        if ($request->hasFile('background')) {
            if ($appSetting->background_image_file_name && file_exists($appSetting->background_image_full_path)) {
                unlink($appSetting->background_image_full_path);
            }
            $reqFile = $request->file('background');
            $fileName = 'background';
            $fileExtension = strtolower($reqFile->getClientOriginalExtension());
            $newFileName = $fileName . '.' . $fileExtension;
            $fileDir = AppSetting::BACKGROUND_DIR;
            try {
                Image::make($reqFile)
                    ->resize(1920, 1080)
                    ->encode($fileExtension, 85)
                    ->save($fileDir . $newFileName);
            } catch (Exception $e) {
                return back()->with($this->errorAlert('Failed to upload!'));
            }

            $appSetting->background_image_dir = $fileDir;
            $appSetting->background_image_file_name = $newFileName;
        }


        $appSetting->save();
        return back()->with($this->successAlert('Successfully updated!'));
    }

    public function optimize(Request $request)
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('optimize:clear');
            Artisan::call('optimize');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with($this->errorAlert('Failed to run optimization'));
        }

        return '<h2 style="text-align:center; margin-top: 50px;">Optimized, go back and refresh</h2>';
    }

    protected function setAppNameToJSON($name)
    {
        if (file_exists('app_configs/app_settings.json')) {
            $appSettingsPath = public_path('app_configs/app_settings.json');
            $getAppName = json_decode(file_get_contents($appSettingsPath), true);
            $getAppName['app_name'] = $name;
            file_put_contents(public_path('app_configs/app_settings.json'),  json_encode($getAppName, JSON_PRETTY_PRINT));
        }
    }
}
