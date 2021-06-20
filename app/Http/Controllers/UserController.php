<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function getRegister()
    {
        return view('auth.register');
    }


    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        $user =     User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        Alert::toast('Welcome, successful registeration', 'success');
        return redirect()->route('user.profile');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);

        $credintials = request(['email', 'password']);
        if (Auth::attempt($credintials)) {
            return redirect()->route('user.profile');
        }
        return redirect()->back()->with(['error' => 'incorrect credintioals']);
    }

    public function profile()
    {
        $user_orders = auth()->user()->orders;
        $orders = $user_orders->transform(function ($cart, $key) {
            return unserialize($cart->cart);
        });


        return view('user.profile')->with('orders', $orders);
    }


    public function Logout()
    {
        Auth::logout();
        return redirect()->route('get.login');
    }
}
