<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('admin.users.list', compact('users'));
    }

    public function create_administrators() {
        return view('admin.users.create');
    }

    public function create() {
        return view('client.user.register');
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

    public function login_form() {
        return view('client.user.login');
    }

    public function login(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email'=>$formFields['email'], 'password'=>$formFields['password']])){
            if(Auth::user()->role == 1) {
                return redirect('admin/category')->with('message', 'Welcome admin');
            }else {
                return redirect('client/')->with('message', 'Login success');
            }
        }else {
            return redirect('user/login')->with('message', 'Email or password is incorrect');
        }
        // dd($request->method());
    }


    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('user/login')->with('message', 'You have been logged out');
    }
}
