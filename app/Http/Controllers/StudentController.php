<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class StudentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $students = User::where('user_type', 2)->get();

        return view('students.index', compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(User $user) {
        return [
            'students' => $user,
            'departments' => Department::where('status', 1)->get(['id', 'name']),
            'batches' => Batch::where('status', 1)->get(['id', 'name']),
            'sesiones' => Session::where('status', 1)->get(['id', 'name']),
            'roles' => Role::get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('students.create', $this->data(new User()));
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
            'gender' => ['required', 'numeric'],
            'date_of_birth' => ['required'],
            'contact_number' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'department_id' => ['required', 'numeric'],
            'batch_id' => ['required', 'numeric'],
            'session_id' => ['required', 'numeric'],
            'earning_credit' => ['required'],
            'address' => ['required', 'string'],
            'inputState' => ['required']
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'images/users/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $image_name = "$profileImage";
        }

        $user = User::create([
            'user_type' => 2,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'security' => $request->password,
            'session_id' => $request->session_id,
            'earning_credit' => $request->earning_credit,
            'image' => ($request->file('image')) ? $image_name : '',
            'address' => $request->address,
            'status' => $request->inputState
        ]);

        // $user->assignRole($request->roles);

        return redirect()->route('students.index')
            ->with('success','Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student) {
        return view('students.edit',  $this->data($student));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'numeric'],
            'date_of_birth' => ['required'],
            'password' => ['required', 'min:6'],
            'department_id' => ['required', 'numeric'],
            'batch_id' => ['required', 'numeric'],
            'session_id' => ['required', 'numeric'],
            'earning_credit' => ['required'],
            'address' => ['required', 'string'],
            'inputState' => ['required']
        ]);

        $student->update([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'security' => $request->password,
            'session_id' => $request->session_id,
            'earning_credit' => $request->earning_credit,
            'address' => $request->address,
            'status' => $request->inputState
        ]);

        // $user->assignRole($request->roles);

        return redirect()->route('students.index')
            ->with('success','Student update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student) {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success','Student deleted successfully');
    }
}
