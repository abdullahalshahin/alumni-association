<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $departments = Department::get();

        return view('departments.index', compact('departments'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(Department $department) {
        return [
            'departments' => $department,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('departments.create', $this->data(new Department()));
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
            'code' => ['required', 'string', 'max:6'],
            'shift' => ['required'],
            'total_credit' => ['required'],
            'inputState' => ['required']
        ]);

        $department = Department::create([
            'name' => $request->name,
            'code' => $request->code,
            'shift' => $request->shift,
            'total_credit' => $request->total_credit,
            'status' => $request->inputState
        ]);

        return redirect()->route('departments.index')
            ->with('success','Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department) {
        return view('departments.show', $this->data($department));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department) {
        return view('departments.edit',  $this->data($department));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:6'],
            'shift' => ['required'],
            'total_credit' => ['required'],
            'inputState' => ['required']
        ]);

        $department->update([
            'name' => $request->name,
            'code' => $request->code,
            'shift' => $request->shift,
            'total_credit' => $request->total_credit,
            'status' => $request->inputState
        ]);

        return redirect()->route('departments.index')
            ->with('success','Department update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department) {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success','Department deleted successfully');
    }
}
