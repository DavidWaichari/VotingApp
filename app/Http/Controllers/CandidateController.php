<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Election;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $all_candidates = Candidate::orderBy('created_at', 'DESC')->get();
        $election_text = 'All Elections';
        $election_id = '';
        //check if election has been passed
        if ($request->election_id) {
            $election = Election::findOrFail($request->election_id);
            $all_candidates = Candidate::where('election_id', $election->id)->orderBy('created_at', 'DESC')->get();
            $election_text = $election->position_name;
            $election_id = $election->id;
        }
        // Sort candidates by the computed no_of_votes attribute in descending order
        $candidates = $all_candidates->sortByDesc(function($candidate) {
            return $candidate->no_of_votes;
        });

        return view('admin/candidates/index',compact('candidates', 'election_text','election_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $election_id = '';
        if ($request->election_id && isset($request->election_id)) {
            $election_id = $request->election_id;
        }
        $elections = Election::where('is_active', 'No')->orderBy('created_at', 'DESC')->get();
        return view('admin/candidates/create',compact('elections', 'election_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $candidate = Candidate::create($request->all());
        if ($request->hasFile('picture')) {
            $candidate->addMedia($request->picture)->toMediaCollection();
        }

        return redirect('/admin/candidates?election_id='.$candidate->election_id)->with('success', 'Successfully added candidate');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function ajaxFetchCandidates()
    {
        return Candidate::all();
    }
    
}
