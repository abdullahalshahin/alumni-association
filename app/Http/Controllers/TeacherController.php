<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TeacherController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:teacher_view|teacher_create|teacher_edit|teacher_delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:teacher_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:teacher_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:teacher_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $teachers = User::where('user_type', 1)->get();

        return view('teachers.index', compact('teachers'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(User $user) {
        return [
            'teachers' => $user,
            'roles' => Role::get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('teachers.create', $this->data(new User()));
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
            'address' => ['required', 'string'],
            'inputState' => ['required']
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'images/users/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $image_name = "$profileImage";
        }

        $teacher = User::create([
            'user_type' => 1,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'security' => $request->password,
            'image' => ($request->file('image')) ? $image_name : '',
            'address' => $request->address,
            'status' => $request->inputState
        ]);

        $teacher->assignRole($request->roles);

        return redirect()->route('teachers.index')
            ->with('success','Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $teacher) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teacher) {
        return view('teachers.edit',  $this->data($teacher));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $teacher) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'numeric'],
            'date_of_birth' => ['required'],
            'password' => ['required', 'min:6'],
            'address' => ['required', 'string'],
            'inputState' => ['required']
        ]);

        $teacher->update([
            'user_type' => 1,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'security' => $request->password,
            'address' => $request->address,
            'status' => $request->inputState
        ]);

        if ($request->roles) {
            $teacher->assignRole($request->roles);
        }

        return redirect()->route('teachers.index')
            ->with('success','Teacher update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher) {
        $teacher->delete();

        return redirect()->route('students.index')
            ->with('success','Teacher deleted successfully');
    }
}
