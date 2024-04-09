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
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'phone' => 'required|integer',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|integer',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/users')->with('error', $validator->errors());
        }

        // $userData = $request->except('confirmPassword');
        // User::create($userData);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password,
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'u_lastname' => 'required|string|max:255',
            'u_firstname' => 'required|string|max:255',
            'u_phone' => 'required|integer',
            'u_email' => 'required|email|unique:users,email',
            'u_role_id' => 'required|integer',
            'u_password' => 'sometimes|string|min:8',
            'u_confirmPassword' => 'sometimes|string|same:u_password',
        ]);

        if ($validator->fails()) {
            return redirect('/users')->with('error', $validator->errors());
        }

        $user = User::findOrFail($id);

        var_dump($request);

        //u_var for update variable
        // $user->update([
        //     'firstname' => $request->u_firstname,
        //     'lastname' => $request->u_lastname,
        //     'phone' => $request->u_phone,
        //     'email' => $request->u_email,
        //     'role_id' => $request->u_role_id,
        // ]);
        $user->firstname = $request->u_firstname;
        $user->lastname = $request->u_lastname;
        $user->phone = $request->u_phone;
        $user->email = $request->u_email;
        $user->role_id = $request->u_role_id;

        if($request->has('u_password')){
            $user->password = $request->u_password;
        }
        $user->save();

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users');
    }

    public function find($id){
        $user = User::findOrFail($id);
        return $user;
    }
}
