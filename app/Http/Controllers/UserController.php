<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::with('roles')->get();
        
        return view('users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(User $user) {
        return [
            'users' => $user,
            'roles' => Role::get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('users.create', $this->data(new User()));
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
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'date_of_birth' => ['required'],
            'gender' => ['required', 'numeric'],
            'phone' => ['required'],
            'position' => ['required', 'string', 'max:100'],
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
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'security' => $request->password,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'image' => ($request->file('image')) ? $image_name : '',
            'address' => $request->address,
            'status' => $request->inputState
        ]);

        $user->assignRole($request->roles);


        return redirect()->route('users.index')
            ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('users.show', $this->data($user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        return view('users.edit',  $this->data($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class, 'email')->ignore($user->id)],
            'password' => ['required', Rules\Password::defaults()],
            'date_of_birth' => ['required'],
            'gender' => ['required', 'numeric'],
            'phone' => ['required', Rule::unique(User::class, 'phone')->ignore($user->id)],
            'position' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string'],
            'inputState' => ['required']
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'images/users/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $image_name = "$profileImage";
        }

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'security' => $request->password,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'image' => ($request->file('image')) ? $image_name : '',
            'address' => $request->address,
            'status' => $request->inputState
        ]);

        $user->syncPermissions($request->roles);

        return redirect()->route('users.index')
            ->with('success','User Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
