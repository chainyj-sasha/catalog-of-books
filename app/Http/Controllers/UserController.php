<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register', [
            'title' => 'Регистрация нового пользователя',
        ]);
    }

    public function create(UserCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'регистрация прошла успешно!');
        Auth::login($user);

        return redirect()->route('sections.index');
    }

    public function loginForm()
    {
        return view('user.loginForm', [
            'title' => 'Форма авторизации',
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        if ($request->has('button')){
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])){
                $request->session()->flash('success', 'вы авторизованы успешно');
                return redirect()->route('sections.index');
            }
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('sections.index');
    }
}
