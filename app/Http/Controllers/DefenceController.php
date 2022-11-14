<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Defence;
use App\Models\Department;
use App\Models\Group;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefenceController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:defence_view|defence_create|defence_edit|defence_delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:defence_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:defence_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:defence_delete', ['only' => ['destroy']]);
        $this->middleware('permission:defence_request|defence_verification', ['only' => ['defenceRequest', 'defenceVerification']]);
        $this->middleware('permission:defence_verification', ['only' => ['defenceVerification']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $defences = Defence::where('status', 1)->get();

        return view('defences.index', compact('defences'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(Defence $defence) {
        return [
            'defences' => $defence,
            'departments' => Department::where('status', 1)->get(['id', 'name']),
            'batches' => Batch::where('status', 1)->get(['id', 'name']),
            'sesiones' => Session::where('status', 1)->get(['id', 'name']),
            'groups' => Group::get(['id', 'name']),
            'students' => User::where('user_type', 2)->get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('defences.create', $this->data(new Defence()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'date' => ['required'],
            'group_id' => ['required'],
            'student_id' => ['required'],
            'details' => ['required'],
            'inputState' => ['required']
        ]);

        $student = User::find($request->student_id);

        $department_credit = $student->session->batch->department->total_credit;
        $student_earning_credit = $student->earning_credit;


        if ($student_earning_credit < $department_credit) {
            return back()->with('error', 'You have not completed all you academic Credits!');
        }

        if ($request->inputState == 1) {
            $varified_by = Auth::user()->id;
            $varified_at = date('Y-m-d H:i:s');
        }
        else {
            $varified_by = NULL;
            $varified_at = NULL;
        }

        $defence = Defence::create([
            'date' => $request->date,
            'group_id' => $request->group_id,
            'student_id' => $request->student_id,
            'marks' => $request->marks,
            'details' => $request->details,
            'seen' => 1,
            'status' => $request->inputState,
            'varified_by' => $varified_by,
            'varified_at' => $varified_at
        ]);

        return redirect()->route('defences.index')
            ->with('success', 'Defence created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Defence  $defence
     * @return \Illuminate\Http\Response
     */
    public function show(Defence $defence) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Defence  $defence
     * @return \Illuminate\Http\Response
     */
    public function edit(Defence $defence) {
        return view('defences.edit',  $this->data($defence));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Defence  $defence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Defence $defence) {
        $request->validate([
            'date' => ['required'],
            'group_id' => ['required'],
            'student_id' => ['required'],
            'details' => ['required'],
            'inputState' => ['required']
        ]);

        $student = User::find($request->student_id);
        $department_credit = $student->session->batch->department->total_credit;
        $student_earning_credit = $student->earning_credit;

        if ($student_earning_credit < $department_credit) {
            return back()->with('error', 'You have not completed all your academic Credits!');
        }

        if ($request->inputState == 1) {
            $varified_by = Auth::user()->id;
            $varified_at = date('Y-m-d H:i:s');
        }
        else {
            $varified_by = NULL;
            $varified_at = NULL;
        }

        $defence->update([
            'date' => $request->date,
            'group_id' => $request->group_id,
            'student_id' => $request->student_id,
            'marks' => $request->marks,
            'details' => $request->details,
            'seen' => 1,
            'status' => $request->inputState,
            'varified_by' => $varified_by,
            'varified_at' => $varified_at
        ]);

        return redirect()->route('defences.index')
            ->with('success', 'Defence update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Defence  $defence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Defence $defence) {
        $defence->delete();

        return redirect()->route('defences.index')
            ->with('success','Defence deleted successfully');
    }

    public function defenceRequest() {
        $defences = Defence::where('status', 0)->get();

        return view('defence_request.index', compact('defences'))->with('i');
    }

    public function defenceVerification(Request $request) {
        return $request;
    }

    public function alumniRegistration() {
        return view('alumni_registration.index');
    }

    public function studentAlumniRequest(Request $request) {
        $request->validate([
            'registration_no' => ['required'],
            'group_id' => ['required'],
            'date' => ['required'],
            'details' => ['required']
        ]);

        $student = User::where('registration_no', $request->registration_no)->first();

        Defence::create([
            'date' => $request->date,
            'group_id' => $request->group_id,
            'student_id' => $student->id,
            'details' => $request->details
        ]);

        return back()->with('success', 'Request Send successfully.');
    }
}
