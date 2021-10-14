<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ChangePasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index()
    {



        return view('auth.change-password');
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {




        $request->validate([

            'oldpassword' => ['required', Rules\Password::defaults()],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = auth()->user();
        if (Hash::check($request->oldpassword, $user['password'])) {
            $user['password'] = Hash::make($request->password);
            $user->save();
            redirect()->route('home');
        } else

            return view('auth.change-password')->with('stt', 'Wrong old Password');
    }
}
