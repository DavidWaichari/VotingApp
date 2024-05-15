<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function vote(Request $request)
    {
        $votes = $request->votes;
        $voter = Auth::user();

        if ($voter->has_voted) {
            return 'You have already voted';
        }

        // Validate request data
        $request->validate([
            'votes' => 'required|array',
        ]);

        if ($votes) {
            foreach ($votes as $vote) {
                Vote::create([
                    "user_id" => $voter->id,
                    "candidate_id" => $vote
                ]);
            }
        }

        return 'Successfully voted';
    }
    
    public function fetchCandidates()
    {
        return Candidate::all();
    }

    public function authUser()
    {
        return Auth::user();
    }

    public function unauthorized()
    {
        return view('401');
    }
}