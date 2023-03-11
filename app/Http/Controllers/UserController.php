<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create() {
        return view('user.register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed'],
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        return redirect('user/login')->with('message', 'User created successfully');
    }

    public function login() {
        return view('user.login');
    }

    public function logout() {
        
    }
}
