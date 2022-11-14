<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Group;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:group_view|group_create|group_edit|group_delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:group_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:group_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:group_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $groups = Group::get();

        return view('groups.index', compact('groups'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(Group $group) {
        return [
            'groups' => $group,
            'departments' => Department::where('status', 1)->get(['id', 'name']),
            'batches' => Batch::where('status', 1)->get(['id', 'name']),
            'sesiones' => Session::where('status', 1)->get(['id', 'name']),
            'teachers' => User::where('user_type', 1)->get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('groups.create', $this->data(new Group()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'session_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['required'],
            'topic_name' => ['required', 'string'],
            'inputState' => ['required']
        ]);

        $group = Group::create([
            'session_id' => $request->session_id,
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'topic_name' => $request->topic_name,
            'status' => $request->inputState
        ]);

        return redirect()->route('groups.index')
            ->with('success', 'Group created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group) {
        return view('groups.edit',  $this->data($group));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group) {
        $request->validate([
            'session_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['required'],
            'topic_name' => ['required', 'string'],
            'inputState' => ['required']
        ]);

        $group->update([
            'session_id' => $request->session_id,
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'topic_name' => $request->topic_name,
            'status' => $request->inputState
        ]);

        return redirect()->route('groups.index')
            ->with('success', 'Group update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group) {
        $group->delete();

        return redirect()->route('sessions.index')
            ->with('success','Group deleted successfully');
    }

    // API
    public function fetchGroup(Request $request) {
        $data['groups'] = Group::where('session_id', $request->session_id)->get(['id', 'name']);

        return response()->json($data);
    }
}
