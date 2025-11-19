<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('welcome');
    }

    // Proses login / register
    public function loginOrRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        // Cek apakah database user masih kosong (belum ada data sama sekali)
        $isFirstUser = User::count() === 0;

        if ($isFirstUser) {
            // ✅ Kalau ini login pertama → simpan langsung tanpa cek
            $newUser = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);

            session(['user_id' => $newUser->id]);
            return redirect('/landing');
        }

        // 🔍 Kalau bukan login pertama → cari user berdasarkan username
        $user = User::where('name', $request->name)->first();

        // Kalau user tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'name' => 'Nama pengguna salah.',
            ])->withInput();
        }

        // ✅ Cek password
        if (Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);
            return redirect('/landing');
        }

        // ❌ Kalau password salah
        return back()->withErrors([
            'password' => 'Kata sandi salah.',
        ])->withInput();
    }

    // Logout user
    public function logout()
    {
        session()->forget('user_id');
        return redirect('/');
    }
}
