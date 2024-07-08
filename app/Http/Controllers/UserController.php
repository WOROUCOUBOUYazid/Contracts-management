<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('users.index', compact('users'));
        return view('users.index', [
            'users' => User::with('serviceProvider')->get(),
            'roles' => Role::all(),
        ]);
    }

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
        $validator = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'phone' => 'required|integer',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|integer',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|same:password',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'residence_place' => 'nullable|string|max:255',
            'adress' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'children_number' => 'nullable|integer',
        ]);

        $user = User::create([
            'firstname' => $validator['firstname'],
            'lastname' => $validator['lastname'],
            'phone' => $validator['phone'],
            'email' => $validator['email'],
            'role_id' => $validator['role_id'],
            'password' => Hash::make($validator['password']),
        ]);


        if($user->role->code == 'serviceProvider'){
            $validator_serv = $request->validate([
                'birth_date' => 'required|date',
                'birth_place' => 'required|string|max:255',
                'residence_place' => 'required|string|max:255',
                'adress' => 'required|string|max:255',
                'marital_status' => 'required|string|max:255',
                'children_number' => 'required|integer',
            ]);

            $user->serviceProvider = ServiceProvider::create([
                'birth_date' => $validator_serv['birth_date'],
                'birth_place' => $validator_serv['birth_place'],
                'residence_place' => $validator_serv['residence_place'],
                'adress' => $validator_serv['adress'],
                'marital_status' => $validator_serv['marital_status'],
                'children_number' => $validator_serv['children_number'],
                'user_id' => $user->id,
            ]);
        }

        // dd($user->serviceProvider);

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
    public function update(Request $request, string $id) {
        $user = User::findOrFail(intval($id));

        $validator = $request->validate([
            'u_lastname' => 'required|string|max:255',
            'u_firstname' => 'required|string|max:255',
            'u_phone' => 'required|integer',
            'u_email' => $user->email != $request->u_email? 'required|email|unique:users,email': 'required|email',
            'u_role_id' => 'required|integer',
            'u_password' => 'nullable|string|min:8',
            'u_confirmPassword' => 'nullable|string|same:password',
            'u_birth_date' => 'nullable|date',
            'u_birth_place' => 'nullable|string|max:255',
            'u_residence_place' => 'nullable|string|max:255',
            'u_adress' => 'nullable|string|max:255',
            'u_marital_status' => 'nullable|string|max:255',
            'u_children_number' => 'nullable|integer',
        ]);

        // if ($validator->fails()) {
        //     // return redirect('/users')->with('error', $validator->errors());
        //     return redirect('/users')->withErrors($validator)->withInput();
        // }

        //u_var for update variable
        $user->update([
            'firstname' => $request->u_firstname,
            'lastname' => $request->u_lastname,
            'phone' => $request->u_phone,
            'email' => $request->u_email,
            'role_id' => $request->u_role_id,
        ]);
        $user->update([
            'firstname' => $validator['u_firstname'],
            'lastname' => $validator['u_lastname'],
            'phone' => $validator['u_phone'],
            'email' => $validator['u_email'],
            'role_id' => $validator['u_role_id'],
            'password' => $validator['u_password']&&Hash::make($validator['u_password']),
        ]);
        if($user->role->code == 'serviceProvider'){
            $user->serviceProvider->update([
                'birth_date' => $validator['u_birth_date'],
                'birth_place' => $validator['u_birth_place'],
                'residence_place' => $validator['u_residence_place'],
                'adress' => $validator['u_adress'],
                'marital_status' => $validator['u_marital_status'],
                'children_number' => $validator['u_children_number'],
                'user_id' => $user->id,
            ]);
        }
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
        $user = User::where('id', intval($id))->with('serviceProvider')->get();
        return $user;
    }
}
