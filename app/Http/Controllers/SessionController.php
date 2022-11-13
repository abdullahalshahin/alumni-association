<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sessions = Session::get();

        return view('sessions.index', compact('sessions'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(Session $session) {
        return [
            'sessions' => $session,
            'departments' => Department::where('status', 1)->get(['id', 'name']),
            'batches' => Batch::where('status', 1)->get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('sessions.create', $this->data(new Session()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'batch_id' => ['required'],
            'inputState' => ['required']
        ]);

        $session = Session::create([
            'name' => $request->name,
            'batch_id' => $request->batch_id,
            'status' => $request->inputState
        ]);

        return redirect()->route('sessions.index')
            ->with('success', 'Session created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session) {
        return view('sessions.edit',  $this->data($session));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'batch_id' => ['required'],
            'inputState' => ['required']
        ]);

        $session->update([
            'name' => $request->name,
            'batch_id' => $request->batch_id,
            'status' => $request->inputState
        ]);

        return redirect()->route('sessions.index')
            ->with('success', 'Session update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session) {
        $session->delete();

        return redirect()->route('sessions.index')
            ->with('success','Session deleted successfully');
    }

    // API
    public function fetchSession(Request $request) {
        $data['sessions'] = Session::where([
                ['status', 1],
                ['batch_id', $request->batch_id]
            ])->get(['id', 'name']);

        return response()->json($data);
    }
}
