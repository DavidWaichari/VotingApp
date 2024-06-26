<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\Election;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(Request $request)
    {
        $all_candidates = Candidate::all();
        $elections = Election::orderBy('created_at', 'DESC')->get();
        $election_line = 'All Elections';
        $votes = Vote::count();
        $election_id = '';
        //check if election_id is set
        if (isset($request->election_id) && $request->election_id) {
            $election = Election::findOrFail($request->election_id);
            $all_candidates = Candidate::where('election_id', $election->id)->get();
            $election_line = $election->position_name.' Elections';
            $election_id = $election->id;
            $votes = Vote::where('election_id',$election->id)->count();

        }
        // Sort candidates by the computed no_of_votes attribute in descending order
        $candidates = $all_candidates->sortByDesc(function($candidate) {
            return $candidate->no_of_votes;
        });
        $registered_voters = User::where('can_vote','yes')->count();
        $unregistered_voters = User::where('can_vote','no')->count();

        return view('admin/dashboard',compact('elections', 'election_id','election_line','candidates','registered_voters', 'unregistered_voters','votes'));
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

}
