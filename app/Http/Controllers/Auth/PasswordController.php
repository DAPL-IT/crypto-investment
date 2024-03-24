<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Traits\AlertTrait;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    use AlertTrait, HelperTrait;

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function customForgotPasswordForm ()
    {
        return view ('auth.forgot-password');
    }

    public function customForgotPasswordMail (Request $request)
    {
        $userNameOrEmail = $request->username;
        $validUser = User::where('username', $userNameOrEmail)->orWhere('email', $userNameOrEmail)->first();
        if($validUser == null){
            return back()->with($this->errorAlert('Invalid Username or Email!'));
        }
        else{
            if($validUser->email != null){
                $newPassword = Str::random(10);
                $validUser->password = Hash::make($newPassword);
                $validUser->save();
    
                Mail::to($validUser->email)->send(new AdminMail($newPassword));
                return back()->with($this->successAlert('Please Check Your Email!'));
            }
            else{
                return back()->with($this->errorAlert('No Email Found!'));
            }
        }
    }
}
