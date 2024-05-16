<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

}
