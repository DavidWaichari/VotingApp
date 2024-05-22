<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;
use App\Models\Candidate;
use App\Imports\VotersImport;
use App\Models\Election;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $voters = User::all();
        $title = 'All';
        if ($request->status == 'registered') {
            $voters = User::where('can_vote','Yes')->get();
            $title = 'Registered';
        }
        elseif ($request->status == 'unregistered') {
            $voters = User::where('can_vote','No')->get();
            $title = 'Unregistered';
        }elseif ($request->status == 'voted') {
            $voters = User::all()->filter(function($user) {
                return $user->has_voted;
            });
            $title = 'Has Voted';
        }elseif ($request->status == 'not_voted') {
            $voters = User::all()->filter(function($user) {
                return $user->can_vote && !$user->has_voted;
            });
            $title = 'Not Voted';
        }
        
        
        return view('admin/voters/index', compact('voters','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/voters/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|unique:users,email|max:255',
            'id_number' => 'string|unique:users,id_number|max:255',
            'phone_number' => 'string|unique:users,phone_number|max:255',
        ]);

        $request['can_vote'] = 'No';
        if ($request->can_vote == 'on') {
            $request['can_vote'] = 'Yes';
        }
        $voter = User::create($request->all());
        if ($request->hasFile('picture')) {
            $voter->addMedia($request->picture)->toMediaCollection();
        }

        return redirect('/admin/voters');
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
    public function edit(string $id)
    {
        $voter = User::findOrFail($id);
        return view('admin/voters/edit', compact('voter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        
        $request['can_vote'] = 'No';
        if ($request->can_vote == 'on') {
            $request['can_vote'] = 'Yes';
        }
        $voter = User::findOrFail($id);
        $voter->update($request->all());
        if ($request->hasFile('picture')) {
            $voter->addMedia($request->picture)->toMediaCollection();
        }

        return redirect('/admin/voters');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->back()->withErrors('Deleting is not allowed at this time');
        $voter = User::findOrFail($id);
        if ($voter->is_admin == 'Yes') {
            return redirect()->back()->withErrors('You cannot delete an admin');
        }
        $voter->delete();

        return redirect('/admin/voters');
    }

    public function importVoters(Request $request)
    {
        Excel::import(new VotersImport(), $request->file('file'));

        return redirect()->back()->with('success', 'Voters imported and saved successfully.');
    }

    public function resultsStreaming(Request $request)
    {
        $elections = Election::all();
        $elections_text = 'All';
        $election_id = '';
        if (isset($request->election_id)) {
           $election = Election::findOrFail($request->election_id);
           $election_id = $election->id; 
           $elections_text = $election->position_name.' ['.$election->created_at->year.']';
        }
        return view('admin/voters/results_streaming', compact('elections_text', 'elections','election_id'));
    }

    public function ajaxResultsStreaming(Request $request)
    {
       
        
        // Retrieve all candidates
        $candidates = Candidate::all();
        // Convert to array and reset keys (optional)
        
        $registered_voters = User::where('can_vote','yes')->count();
        $unregistered_voters = User::where('can_vote','no')->count();
        $all_users = User::all();
        $voters_count = Vote::all()->pluck('user_id')->unique()->count();;
        
        $votes = Vote::count();
        
        //check if there is an election filter
        if (isset($request->election_id)) {
            $candidates = Candidate::where('election_id', $request->election_id)->get();
            $voters_count = 0 ;
            $votes = Vote::where('election_id', $request->election_id)->count();
            //get voters count
            foreach ($all_users as $user) {
                if ($this->userHasVoted($request->election_id, $user)->getData()->success) {
                   $voters_count ++ ;
                }
            }
        }
        // Sort candidates by the computed no_of_votes attribute in descending order
        $sortedCandidates = $candidates->sortByDesc(function($candidate) {
            return $candidate->no_of_votes;
        });
        $sortedCandidates = $sortedCandidates->values()->all();

        $data = [
            'candidates' => $sortedCandidates,
            'registered_voters_count' => $registered_voters,
            'unregistered_voters_count' => $unregistered_voters,
            'votes_count' => $votes,
            'voters_count' => $voters_count
        ];

        return response()->json($data);

    }

    public function vote(Request $request)
    {
        $votes = $request->votes;
        $voter = Auth::user();
        //check if the user has participated in this election
        if ($this->userHasVoted($request->election_id)['success']) {
            return response()->json([
                'success'=>false,
                'message'=>'You have already participated in this election'
            ]);
        }
        // Validate request data
        $request->validate([
            'votes' => 'required|array',
            'election_id' => 'required|integer'
        ]);

        if ($votes) {
            foreach ($votes as $vote) {
                Vote::create([
                    "user_id" => $voter->id,
                    "candidate_id" => $vote,
                    "election_id" => $request->election_id
                ]);
            }
        }

        return response()->json([
            'success'=>true
        ]);
    }

    public function userHasVoted($election_id, $user = null)
    {
        // Use the provided user or default to the authenticated user
        $user = $user ?? Auth::user();
    
        if (!$user) {
            // Handle case where there is no authenticated user and no user provided
            return response()->json(['success' => false, 'message' => 'No user specified'], 400);
        }
    
        $vote = Vote::where('user_id', $user->id)->where('election_id', $election_id)->first();
        if ($vote) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    

}
