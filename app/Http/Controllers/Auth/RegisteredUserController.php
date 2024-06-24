<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\Role;
use App\Models\ServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'integer'],
            'role_id' => ['required', 'string', 'max:255', 'exists:roles,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => ['nullable', 'date'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'residence_place' => ['nullable', 'string', 'max:255'],
            'adress' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'string', 'max:255'],
            'children_number' => ['nullable', 'integer'],
        ]);

        // dd($request);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        if (
            $request->birth_date &&
            $request->birth_place &&
            $request->residence_place &&
            $request->adress &&
            $request->marital_status &&
            $request->children_number
        ) {
            $user->serviceProvider = ServiceProvider::create([
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'residence_place' => $request->residence_place,
                'adress' => $request->adress,
                'marital_status' => $request->marital_status,
                'children_number' => $request->children_number,
                'user_id' => $user->id,
            ]);
        }

        // dd($user->serviceProvider);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect('/users');
    }
}
