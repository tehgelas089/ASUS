<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $id = session('user_id');

        // Kalau belum login
        if (!$id) {
            return redirect('/');
        }

        // Ambil user dari database
        $user = User::find($id);

        return view('akun', compact('user'));
    }

    // 🔥 Tambahan: Update Nama & Password
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:3'
        ]);

        $id   = session('user_id');
        $user = User::find($id);

        if (!$user) {
            return redirect('/');
        }

        // Update nama
        $user->name = $request->name;

        // Update password hanya jika user mengisi password
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
