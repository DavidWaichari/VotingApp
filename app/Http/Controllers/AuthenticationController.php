<?php

namespace App\Http\Controllers;

use App\Mail\OTPMail;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function requestOTP(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id_number' => 'required|string|max:255',
        ]);

        // Find the user by ID number
        $user = User::where('id_number', $request->id_number)->first();
        if (!$user) {
            return redirect()->back()->withErrors('Member with that ID is not found');
        }

        // Generate a 5-digit OTP
        $otp = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        // Store the OTP in the user's record
        $user->otp = $otp;
        $user->save();

        // Send email containing the OTP (assuming a Mail implementation exists)
        if (isset($user->email)) {
            Mail::to($user->email)->send(new OTPMail($otp));
        }

        // Flash the OTP to the session for testing/debugging purposes
        // In production, this should be removed or handled differently
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
        //remove user otp
        $user->otp ='';
        $user->save();
        //log in the user
        Auth::login($user);

        return redirect('/home');
    }
}
