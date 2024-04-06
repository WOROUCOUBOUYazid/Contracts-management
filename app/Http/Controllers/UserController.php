<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        // return view('admin.users', ['users' => $users]);
        return view('admin.users', compact('users'));
    }

    // public function index() {
    //     // return view('home', [
    //     //     // 'articles' => Post::all()
    //     // ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'phone' => 'required|integer',
            'email' => 'required|email|unique',
            'role_id' => 'required|integer',
            'password' => 'required|string|min:8',
        ]);

        // if ($validator->fails()) {
        //     return redirect('/users')->with('error', $validator->errors());
        // }

        // $userData = $request->except('confirmPassword');
        // User::create($userData);

        

        $user = User::create([
            User->firstname => $request->firstname,
            User->lastname => $request->lastname,
            User->phone => $request->phone,
            User->email => $request->email,
            User->role_id => $request->role_id,
            User->password => $request->password,
        ]);

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
