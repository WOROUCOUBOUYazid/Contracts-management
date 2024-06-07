<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ServiceProvider;
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
            // return redirect('/users')->with('error', $validator->errors());
            return redirect('/users')->withErrors($validator)->withInput();
        }

        // $userData = $request->except('confirmPassword');
        // User::create($userData);

        // dd($request);
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password,
        ]);

        //role=3 is for serviceProvider
        if ($request->role_id == 3) {

            $validator = Validator::make($request->all(), [
                'birth_date' => 'required|date',
                'birth_place' => 'required|string|max:255',
                'residence_place' => 'required|string|max:255',
                'marital_status' => 'required|string|max:255',
                'children_number' => 'required|integer',
            ]);
    
            // if ($validator->fails()) {
            //     return redirect('/users')->with('error', $validator->errors());
            // }

            if ($validator->fails()) {
                return redirect('/users')->withErrors($validator)->withInput();
            }
    
            // dd($errors->all());

            $user->serviceProvider = ServiceProvider::create([
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'residence_place' => $request->residence_place,
                'marital_status' => $request->marital_status,
                'children_number' => $request->children_number,
                'user_id' => $user->id,
            ]);
        }

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
            'u_role_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            // return redirect('/users')->with('error', $validator->errors());
            return redirect('/users')->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);

        //u_var for update variable
        $user->update([
            'firstname' => $request->u_firstname,
            'lastname' => $request->u_lastname,
            'phone' => $request->u_phone,
            'role_id' => $request->u_role_id,
        ]);
        if($request->u_email !== NULL){
            if($request->u_email !== $user->email){
                $validator = Validator::make($request->all(), [
                    'u_email' => 'required|email|unique:users,email|',
                ]);

                $user->email = $request->u_email;
                $user->save();
            }
        }
        
        
        if($request->u_password !== NULL){
            $user->password = $request->u_password;
            $user->save();
        }

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users');
    }

    public function find($id){
        $user = User::findOrFail($id);
        return $user;
    }
}
