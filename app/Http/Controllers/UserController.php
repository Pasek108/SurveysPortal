<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    // index - show all
    // show - show single
    // create - show form to create
    // store - store what created
    // edit - show form to edit
    // update - update what edited
    // destroy - delete

    public function show() {
        return view('pages.users.profile');
    }

    public function create() {
        return view('pages.users.register');
    }

    public function store(Request $request) {
        $form_fields = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'name' => ['required', 'min:3'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $form_fields['password'] = bcrypt($form_fields['password']);

        $user = User::create($form_fields);

        Auth::login($user, $request->get('remember-me'));

        return redirect('/')->with('message', 'user created successfully and logged in');
    }

    public function login() {
        return view('pages.users.login');
    }

    public function auth(Request $request) {
        $form_fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($form_fields)) {
            $request->session()->regenerate();

            return redirect('/')->with("Logged in successfully");
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out successfully');
    }
}
