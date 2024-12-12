<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Peran;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $id = Auth::id();
            $activity = [
                'id_user' => $id,
                'aksi' => 'masuk'
            ];
            ActivityLog::create($activity);
            return redirect('/');
        }

        return back()->withErrors([
            'error' => 'Username atau Password salah',
        ]);
    }

    public function logout(Request $request)
    {
        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'keluar'
        ];
        ActivityLog::create($activity);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('masuk');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $perans = Peran::all(); // Mengambil semua data peran

        return view('pages.profil.index', compact('user', 'perans'));
    }

    public function editProfil($id)
    {
        $user = User::findOrFail($id);
        $perans = Peran::all(); // Mengambil semua data peran

        return view('pages.profil.edit', compact('user', 'perans'));
    }

    public function updateProfil(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data yang diterima
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id . '|regex:/^\S*$/u',
            'password' => 'nullable|string|min:8',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.unique' => 'Username sudah terdaftar, silakan pilih username lain.',
            'username.regex' => 'Username tidak boleh mengandung spasi.',

            'password.min' => 'Password harus minimal 8 karakter.',

            'foto_profil.image' => 'Foto profil harus berupa gambar.',
            'foto_profil.mimes' => 'Foto profil harus berformat: jpeg, png, jpg, gif, atau svg.',
            'foto_profil.max' => 'Ukuran foto profil tidak boleh lebih dari 2MB.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $imagePath = $request->file('foto_profil')->store('foto_profil', 'public');
            $user->foto_profil = $imagePath;
        }

        $user->nama = $request->nama;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'memperbarui profil'
        ];
        ActivityLog::create($activity);
        return redirect()->route('profil.index', $user->id)->with('success', 'Profil berhasil diupdate.');
    }
}
