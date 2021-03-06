<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|min:8|max:255'
        ]);

        $validate['password'] = bcrypt($validate['password']);

        User::create($validate);

        // $request->session()->flash('success', 'Successfully registered!');
        return redirect('/login')->with('success', 'Successfully registered! Please login');
    }
}
