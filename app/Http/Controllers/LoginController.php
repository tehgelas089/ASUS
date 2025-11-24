<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{

    public function showLogin()
    {
        return view('welcome');
    }


    public function loginOrRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);


        $isFirstUser = User::count() === 0;

        if ($isFirstUser) {

            $newUser = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);

            session(['user_id' => $newUser->id]);
            return redirect('/landing');
        }


        $user = User::where('name', $request->name)->first();


        if (!$user) {
            return back()->withErrors([
                'name' => 'Nama pengguna salah.',
            ])->withInput();
        }


        if (Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);
            return redirect('/landing');
        }


        return back()->withErrors([
            'password' => 'Kata sandi salah.',
        ])->withInput();
    }


    public function logout()
    {
        session()->forget('user_id');
        return redirect('/');
    }
}
