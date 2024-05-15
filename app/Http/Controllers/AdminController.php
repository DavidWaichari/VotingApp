<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use AfricasTalking\SDK\AfricasTalking;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard()
    {
        $candidates = Candidate::count();
        $registered_voters = User::where('can_vote','yes')->count();
        $unregistered_voters = User::where('can_vote','no')->count();
        $votes = Vote::count();
        return view('admin/dashboard',compact('candidates','registered_voters', 'unregistered_voters','votes'));
    }

    public function candidates()
    {
        $candidates = Candidate::all();
        return view('admin/candidates',compact('candidates'));
    }

    public function createCandidate()
    {
        return view('admin/create_candidate');
    }

    public function saveCandidate(Request $request)
    {
        $candidate = Candidate::create($request->all());
        if ($request->hasFile('picture')) {
            $candidate->addMedia($request->picture)->toMediaCollection();
        }

        return redirect('/admin/candidates');
    }

    public function registeredVoters()
    {
        $registered_voters = User::where('can_vote','Yes')->get();
        return view('admin/registered_voters', compact('registered_voters'));
    }

    public function unregisteredVoters()
    {
        $unregistered_voters = User::where('can_vote','No')->get();
        return view('admin/unregistered_voters', compact('unregistered_voters'));
    }

    public function sendSMS()
    {

        // Set your app credentials
        $username   = "Jowakabi";
        $apiKey     = "47a67924447d4928f658c9aae31251e7d21c566a7c9928fc4f77164edcf92353";

        // Initialize the SDK
        $AT         = new AfricasTalking($username, $apiKey);

        // Get the SMS service
        $sms        = $AT->sms();

        // Set the numbers you want to send to in international format
        $recipients = "254708473015";

        // Set your message
        $message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";

        // Set your shortCode or senderId
        $from       = "2689";

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to'      => $recipients,
                'message' => $message,
                'from'    => $from
            ]);

            print_r($result);
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
    }

    function createVoter()
    {
        return view('admin/create_voter');
    }
}
