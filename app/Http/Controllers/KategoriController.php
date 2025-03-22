<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Kategori;
use App\Notifications\KategoriNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::orderBy('created_at', 'desc')->get();

        return view("pages.kategori.index", compact("kategoris"));
    }

    public function create()
    {
        return view("pages.kategori.create");
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required|string|max:50|unique:kategoris,nama',
            'deskripsi' => 'nullable|string',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.unique' => 'Nama sudah terdaftar, silakan pilih nama lain.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validatedData->errors(),
            ], 422); // Gunakan status HTTP 422 untuk validasi gagal
        }

        $kategori = new Kategori();
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->save();

        // Kirim notifikasi store
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new KategoriNotification('store', $kategori));

        // Catat aktivitas
        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'menambah kategori baru ' . $request->nama
        ];
        ActivityLog::create($activity);

        return redirect()->route('kategori.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('pages.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validatedData = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.unique' => 'Nama sudah terdaftar, silakan pilih nama lain.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;

        $kategori->save();

        // Kirim notifikasi update
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new KategoriNotification('update', $kategori));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'memperbarui data kategori ' . $request->nama
        ];
        ActivityLog::create($activity);

        return redirect()->route('kategori.index')->with('success', 'Data Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'kategoris' => 'required|array',
            'kategoris.*' => 'exists:kategoris,id',
        ], [
            'kategoris.required' => 'Silakan pilih setidaknya satu kategori untuk dihapus.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $kategoriIdsToDelete = $request->input('kategoris');
        $kategoriNames = Kategori::whereIn('id', $kategoriIdsToDelete)->pluck('nama')->toArray();
        Kategori::whereIn('id', $kategoriIdsToDelete)->delete();

        // Kirim notifikasi destroy
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new KategoriNotification('destroy', $kategoriNames));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'menghapus kategori'
        ];
        ActivityLog::create($activity);

        return redirect()->route('kategori.index')->with('success', 'Kategori terpilih berhasil dihapus.');
    }
}
