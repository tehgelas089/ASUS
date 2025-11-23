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

        if (!$id) {
            return redirect('/');
        }

        $user = User::find($id);
        $total = Revenue::sum('income');

        $history7days = Revenue::selectRaw('DATE(created_at) as date, SUM(income) as total_income')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('akun', compact('user', 'total', 'history7days'));
    }

    public function edit()
    {
        $id = session('user_id');
        $user = User::find($id);

        if (!$user) {
            return redirect('/');
        }

        return view('edit', [
            'user' => $user,
            'title' => 'Edit Profil'
        ]);
    }

    // 🔥 Update Nama, Password, dan Foto Profil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:3',
            'usr_card_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $id   = session('user_id');
        $user = User::find($id);

        if (!$user) {
            return redirect('/');
        }

        // 🔥 Update nama
        $user->name = $request->name;

        // 🔥 Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 🔥 Upload foto profil
        if ($request->hasFile('usr_card_url')) {

            // Hapus foto lama jika ada
            if ($user->usr_card_url && file_exists(public_path($user->usr_card_url))) {
                unlink(public_path($user->usr_card_url));
            }

            $file = $request->file('usr_card_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            // Simpan path ke DB
            $user->usr_card_url = 'uploads/profile/' . $filename;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
