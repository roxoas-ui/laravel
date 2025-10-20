<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    public function show()
    {
        return view('auth.2fa');
    }

    public function verify(Request $request)
    {
        $request->validate(['one_time_password' => 'required']);
        $user = $request->user();
        $google2fa = new Google2FA();
        if ($google2fa->verifyKey($user->two_fa_secret, $request->input('one_time_password'))) {
            $request->session()->put('2fa_passed', true);
            return redirect('/');
        }
        return back()->withErrors(['one_time_password' => 'Código inválido']);
    }
}
