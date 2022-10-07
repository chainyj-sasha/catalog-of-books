<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create', [
            'title' => 'Регистрация',
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => 0,
        ]);
        Auth::login($user);

        return redirect()->route('show_all_section')->with('success', 'Регистрация прошла успешно!');
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->back()->with('success', 'Авторизация прошла успешно!');
        }
        return redirect()->back()->with('error', 'Логин или пароль введены неверно');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
