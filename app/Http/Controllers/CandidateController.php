<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_candidates = Candidate::all();
        // Sort candidates by the computed no_of_votes attribute in descending order
        $candidates = $all_candidates->sortByDesc(function($candidate) {
            return $candidate->no_of_votes;
        });

        return view('admin/candidates/index',compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/candidates/create');
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

        return redirect('/admin/candidates');
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
