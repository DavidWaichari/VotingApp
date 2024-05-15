<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthenticationController extends Controller
{
    public function requestOTP(Request $request)
    {
        $user = User::where('id_number', $request->id_number)->first();
        if (!$user) {
            return redirect()->back()->withErrors('Member with that ID is not found');
        }
        //generate otp
        $otp = mt_rand(1, 10000);
        $user->otp = $otp;
        $user->save();
        return redirect(route('validate.otp'))->withErrors($otp);

    }

    public function validateOtp()
    {
       return view('auth.validate_otp');
    }

    
    public function validateOtpStore(Request $request)
    {
        $user = User::where('otp', $request->otp)->first();
        if (!$user) {
            return redirect()->back()->withErrors('Otp provided is invalid. Please request again');
        }
        //login the user
        Auth::login($user);

        return redirect('/home');
    }

}
