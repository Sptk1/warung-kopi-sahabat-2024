<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Meja;
use App\Notifications\MejaNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::orderBy('created_at', 'desc')->get();

        return view("pages.meja.index", compact("mejas"));
    }

    public function create()
    {
        return view("pages.meja.create");
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:mejas,nama',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.unique' => 'Nama sudah terdaftar, silakan pilih nama lain.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $meja = new Meja();
        $meja->nama = $request->nama;
        $meja->save();

        // Kirim notifikasi store
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new MejaNotification('store', $meja));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'menambah meja baru'
        ];
        ActivityLog::create($activity);

        return redirect()->route('meja.index')->with('success', 'Meja baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $meja = Meja::findOrFail($id);

        return view('pages.meja.edit', compact('meja'));
    }

    public function update(Request $request, $id)
    {
        $meja = Meja::findOrFail($id);

        $validatedData = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:mejas,nama,' . $meja->id,
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.unique' => 'Nama sudah terdaftar, silakan pilih nama lain.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $meja->nama = $request->nama;
        $meja->save();

        // Kirim notifikasi update
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new MejaNotification('update', $meja));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'memperbarui data meja ' . $request->nama
        ];
        ActivityLog::create($activity);

        return redirect()->route('meja.index')->with('success', 'Data meja berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'mejas' => 'required|array',
            'mejas.*' => 'exists:mejas,id',
        ], [
            'mejas.required' => 'Silakan pilih setidaknya satu meja untuk dihapus.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $mejaIdsToDelete = $request->input('mejas');
        $mejaNames = Meja::whereIn('id', $mejaIdsToDelete)->pluck('nama')->toArray();
        Meja::whereIn('id', $mejaIdsToDelete)->delete();


        // Kirim notifikasi destroy
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new MejaNotification('destroy', $mejaNames));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'menghapus meja'
        ];
        ActivityLog::create($activity);

        return redirect()->route('meja.index')->with('success', 'Meja terpilih berhasil dihapus.');
    }
}
