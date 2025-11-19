<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
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
        $total = Revenue::sum('income');
        return view('akun', compact('user', 'total'));
    }

    // 🔥 Tambahan: Update Nama & Password
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:3',
            'usr_card_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'  // 🔥 validasi foto
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

        // 🔥 Upload foto profil (TAMBAHAN, tidak mengganggu kode lain)
        if ($request->hasFile('usr_card_url')) {
            $file = $request->file('usr_card_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            $user->usr_card_url = 'uploads/profile/' . $filename;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
