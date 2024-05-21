<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Election;
use Carbon\Carbon;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elections = Election::orderBy('created_at', 'DESC')->get();

        return view('admin/elections/index', compact('elections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/elections/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $election = Election::create($request->all());
        return redirect(route('elections.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $election = Election::findOrFail($id);
        return view('admin/elections/show', compact('election'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $election  = Election::findOrFail($id);

        return view('admin/elections/edit', compact('election'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $election  = Election::findOrFail($id);
        $election->update($request->all());
        return redirect(route('elections.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->back()->withErrors('Deleting an election is not allowed at this time');
        $election  = Election::findOrFail($id);
        $election->delete();
        return redirect(route('elections.index'));
    }

    public function startElection($id)
    {
        $election  = Election::findOrFail($id);
        $election->is_active = 'Yes';
        $election->started_at = Carbon::now();
        $election->save();

        return redirect()->back()->with('success', 'Election started successfully.');
    }

    public function stopElection($id)
    {
        $election  = Election::findOrFail($id);
        $election->is_active = 'No';
        $election->ended_at = Carbon::now();
        $election->save();
        return redirect()->back()->with('success','Election stopped successfully');
    }

    public function electionsAjax()
    {
        return Election::where('is_active', 'Yes')->with('candidates')->get();
    }

    public function participate($id)
    {
        $election  = Election::findOrFail($id);
        return view('election', compact('election'));
    }

    public function electionsAjaxFetch($id)
    {
        $election  = Election::findOrFail($id);
        //check if the election is active
        if ($election->is_active == 'No') {
            return response()->json([
                'success'=>false
            ]);
        }

        return response()->json([
            'success'=>true,
            'data' => $election->with('candidates')->first()
        ]
        );
    }
}
