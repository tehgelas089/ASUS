<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\RevenueHistory;
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

        $history7days = \App\Models\RevenueHistory::where('date', '>=', now()->subDays(7))
            ->orderBy('date', 'desc')
            ->get();



        return view('akun', compact('user', 'total', 'history7days'));
    }

    //  Method tambahan 
    public function akun()
    {

        $response = $this->index();


        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            return $response;
        }


        return $response->with('title', 'akun saya');
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


        $user->name = $request->name;


        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('usr_card_url')) {


            if ($user->usr_card_url && file_exists(public_path($user->usr_card_url))) {
                unlink(public_path($user->usr_card_url));
            }

            $file = $request->file('usr_card_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);


            $user->usr_card_url = 'uploads/profile/' . $filename;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
