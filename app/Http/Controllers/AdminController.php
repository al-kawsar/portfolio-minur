<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_menu = "admins";
        $admins = User::where('role', 2)->latest()->get();
        return view('admin.admins.index', compact("type_menu", "admins"));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:3|max:255'
        ], [
            'name.required' => 'nama wajib diisi!',
            'email.required' => "username wajib diisi!",
            'email.email' => "username tidak valid!",
            'email.unique' => "username sudah digunakan,gunakan username yang lain!",
            'password.required' => "password tidak boleh kosong",
            'password.min' => "password minimal 3 karakter!"
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => "2"
        ]);

        return back()->with('success', 'Admin Berhasil Ditambahkan');
    }

    public function show(User $user)
    {
        $type_menu = "admins";
        return view('admin.admins.detail', compact('type_menu', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => "required|max:255",
            'email' => $request->email != $user->email ? 'required|unique:users|max:255' : '',
        ], [
            'name.required' => "nama tidak boleh kosong!",
            'email.required' => "email tidak boleh kosong!",
            'email.unique' => "email sudah di gunakan,gunakan email yang lain!"
        ]);

        User::where('id', $user->id)
            ->update($validatedData);

        return redirect()->route('admins.detail', $request->email)->with('success', "Data Berhasil Diubah");
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect()->route('admins')->with('success', "Data Berhasil Dihapus");
    }
}
