<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\AlertTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use AlertTrait;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'min:6', 'max:50', 'unique:users,username'],
            'email' => ['nullable', 'string', 'email', 'max:250'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()->min(6)],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'invitation_code' => ['nullable', 'string', 'max:250'],
        ]);

        $user = new User();

        if ($request->has('invitation_code') && is_null($request->invitation_code) === false) {
            $inviter = User::where('username', $request->invitation_code)->first();
            if ($inviter == null) {
                return redirect()
                    ->back()
                    ->with($this->errorAlert('Invalid invitation code'));
            }
            $user->inviter_id = $inviter->id;
        }

        $user->fill($request->only([
            'username',
            'email',
            'whatsapp',
        ]));

        $user->password = Hash::make($request->password);
        $user->save();


        event(new Registered($user));

        // Auth::login($user);

        return redirect()
            ->route('login')
            ->with(
                $this->successAlert('Registered Successfully, use your credentials to login')
            );
    }
}
