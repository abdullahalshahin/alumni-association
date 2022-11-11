<?php

namespace App\Http\Controllers;

use App\Models\Defence;
use App\Models\Group;
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
    public function index() {
        $defences = Defence::get();

        return view('defences.index', compact('defences'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(Defence $defence) {
        return [
            'defences' => $defence,
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

        $student_earning_credit = 127;
        $department_credit = 137;

        if ($student_earning_credit < $department_credit) {
            return back()->with('success', 'sdfzsdgasdgsg.');
        }
        
        if (Auth::user()->user_type == 0) {
            $varified_by = Auth::user()->id;
            $varified_at = Carbon::today()->toDateString();
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
            'status' => $request->inputState,
            'varified_by' => $varified_by,
            'varified_at' => $varified_at,
        ]);

        return redirect()->route('defences.index')
            ->with('success', 'Department created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Defence  $defence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Defence $defence) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Defence  $defence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Defence $defence) {
        //
    }
}
