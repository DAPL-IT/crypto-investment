<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserImage;
use App\Traits\AlertTrait;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    use AlertTrait, HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with(
            'user_image',
            'user_invitation_code',
            'user_transaction_brief',
            'user_profile'
        )
            ->where('id', Auth::user()->id)
            ->first();

        $inviter = null;
        if ($user->inviter_id) {
            $inviter = User::where('id', $user->inviter_id)->first();
        }
        return view('pages.profile.index', compact(['inviter', 'user']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function generalEdit()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('pages.profile.edit_general', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function generalUpdate(Request $request)
    {
        $request->validate(
            [
                'whatsapp' => 'required|max:50|string',
                'email' => 'nullable|email',
                'phone' => 'nullable|max:50'
            ],
            [
                'whatsapp.required' => 'Telegram is required',
                'whatsapp.max' => 'Invalid Telegram!'
            ]
        );

        $user = User::findOrFail(Auth::user()->id);
        $user->whatsapp = $request->whatsapp;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()
            ->route('user_profile.index')
            ->with($this->successAlert('Successfully updated!'));
    }

    public function passwordEdit()
    {
        return view('pages.profile.edit_password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate(
            [
                'prevpwd' => 'required',
                'newpwd' => 'required|min:6|confirmed',
            ],
            [
                'prevpwd.required' => 'Enter your previous password',
                'newpwd.required' => 'New password cannot be empty!',
                'newpwd.min' => 'New password should contain minimum of 6 characters',
                'newpwd.confirmed' => 'New password confirmation did not match'
            ]
        );
        $user = User::findOrFail(Auth::user()->id);

        if (!(Hash::check($request->prevpwd, $user->password))) {
            return back()->with($this->errorAlert('Previous password did not match'));
        }

        $user->password = Hash::make($request->newpwd);
        $user->save();
        return redirect()
            ->route('user_profile.index')
            ->with($this->successAlert('Successfully updated!'));
    }

    public function imageEdit()
    {
        $user = User::with('user_image')
            ->where('id', Auth::user()->id)
            ->first();
        return view('pages.profile.image', compact(['user']));
    }

    public function imageUpdate(Request $request)
    {
        $request->validate(
            [
                'image' => 'nullable|image|mimes:png,jpg,jpeg|min:1|max:3073',
            ],
            [
                'image.min' => 'Invalid image',
                'image.max' => 'Image cannot be more than 3Mb',
                'image.min' => 'Invalid image',
            ]
        );

        $user = User::findOrFail(Auth::user()->id);
        $userImage = UserImage::where('user_id', $user->id)->first();

        if (!$userImage) {
            $userImage = new UserImage();
        } else {
            if (file_exists($userImage->image_full_path)) {
                unlink($userImage->image_full_path);
            }
        }

        $reqFile = $request->file('image');
        $fileName = pathinfo($reqFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = strtolower($reqFile->getClientOriginalExtension());
        $newFileName = Str::random(8) . '-' . $this->generateFileName($fileName, $fileExtension);
        $fileDir = UserImage::IMAGE_DIR;

        $userImage->image_dir =  $fileDir;
        $userImage->file_name = $newFileName;
        $userImage->user_id = $user->id;

        try {
            Image::make($reqFile)
                ->fit(200, 200)
                ->encode($fileExtension, 70)
                ->save($fileDir . $newFileName);
        } catch (Exception $e) {
            return back()->with($this->errorAlert('Failed to upload!'));
        }

        $userImage->save();

        return redirect()
            ->route('user_profile.index')
            ->with($this->successAlert('Successfully uploaded!'));
    }

    public function imageDelete()
    {
        $user = User::findOrFail(Auth::user()->id);
        $userImage = UserImage::where('user_id', $user->id)->first();

        if (file_exists($userImage->image_full_path)) {
            unlink($userImage->image_full_path);
        }

        $userImage->delete();

        return redirect()
            ->route('user_profile.index')
            ->with($this->successAlert('Successfully deleted!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
