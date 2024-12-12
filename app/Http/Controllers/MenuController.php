<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Kategori;
use App\Models\Menu;
use App\Notifications\MenuNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{

    public function index()
    {
        $kategoris = Kategori::orderBy('created_at', 'asc')->get();
        $menus = Menu::with('kategori')->orderBy('created_at', 'desc')->get();

        return view("pages.menu.index", compact("menus", "kategoris"));
    }

    public function create()
    {
        $kategoris = Kategori::get();

        return view("pages.menu.create", compact("kategoris"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id',
            'harga_modal' => 'required|string',
            'harga_jual' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid.',

            'harga_modal.required' => 'Harga modal wajib diisi.',
            'harga_modal.string' => 'Harga modal harus berupa angka.',

            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.string' => 'Harga jual harus berupa angka.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'foto.image' => 'Foto profil harus berupa gambar.',
            'foto.mimes' => 'Foto profil harus berformat: jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran foto profil tidak boleh lebih dari 2MB.',
        ]);

        if ($request->file('foto')) {
            $imagePath = $request->file('foto')->store('foto_menu', 'public');
        } else {
            $imagePath = null;
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Menghilangkan format uang (titik) dari `harga_modal` dan `harga_jual`
        $validatedData['harga_modal'] = (int) str_replace('.', '', $request->harga_modal);
        $validatedData['harga_jual'] = (int) str_replace('.', '', $request->harga_jual);

        $menu = new Menu();
        $menu->nama = $validatedData['nama'];
        $menu->id_kategori = $validatedData['id_kategori'];
        $menu->harga_modal = $validatedData['harga_modal'];
        $menu->harga_jual = $validatedData['harga_jual'];
        $menu->deskripsi = $validatedData['deskripsi'];
        $menu->foto = $imagePath;
        $menu->save();

        // Kirim notifikasi store
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new MenuNotification('store', $menu));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'menambah menu baru ' . $request->nama
        ];
        ActivityLog::create($activity);

        return redirect()->route('menu.index')->with('success', 'Menu baru berhasil ditambahkan.');
    }

    public function show(Request $request)
    {
        $id = $request->id; // Mengambil ID dari query parameter
        $menu = Menu::with('kategori')->findOrFail($id); // Mengambil data menu dan kategori berdasarkan ID

        // Mengembalikan data dalam format JSON
        return response()->json([
            'nama' => $menu->nama,
            'id_kategori' => $menu->kategori->nama, // Nama kategori (sesuaikan dengan kolom nama di tabel kategori)
            'harga_jual' => number_format($menu->harga_jual, 0, ',', '.'), // Format harga
            'deskripsi' => $menu->deskripsi,
            'foto' => $menu->foto,
            'diff' => $menu->created_at->diffForHumans(), // Tampilkan perbedaan waktu sejak dibuat
        ]);
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = Kategori::all();

        return view('pages.menu.edit', compact('menu', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id',
            'harga_modal' => 'required|string', // Perlu 'string' karena formatnya mengandung titik
            'harga_jual' => 'required|string', // Perlu 'string' karena formatnya mengandung titik
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'harga_modal.required' => 'Harga modal wajib diisi.',
            'harga_modal.string' => 'Harga modal harus berupa angka.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.string' => 'Harga jual harus berupa angka.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'foto.image' => 'Foto profil harus berupa gambar.',
            'foto.mimes' => 'Foto profil harus berformat: jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran foto profil tidak boleh lebih dari 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Menghilangkan format uang (titik) dari `harga_modal` dan `harga_jual`
        $validatedData['harga_modal'] = (int) str_replace('.', '', $request->harga_modal);
        $validatedData['harga_jual'] = (int) str_replace('.', '', $request->harga_jual);

        if ($request->hasFile('foto')) {
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            $imagePath = $request->file('foto')->store('foto_menu', 'public');
            $menu->foto = $imagePath;
        }

        $menu->nama = $validatedData['nama'];
        $menu->id_kategori = $validatedData['id_kategori'];
        $menu->harga_modal = $validatedData['harga_modal'];
        $menu->harga_jual = $validatedData['harga_jual'];
        $menu->deskripsi = $validatedData['deskripsi'];

        $menu->save();

        // Kirim notifikasi update
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new MenuNotification('update', $menu));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'memperbarui data menu ' . $request->nama
        ];
        ActivityLog::create($activity);

        return redirect()->route('menu.index')->with('success', 'Data menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        // Kirim notifikasi destroy
        $emailTujuan = 'wksahabatptk@gmail.com';
        Notification::route('mail', $emailTujuan)->notify(new MenuNotification('destroy', $menu));

        $id = Auth::id();
        $activity = [
            'id_user' => $id,
            'aksi' => 'menghapus menu ' . $menu->nama
        ];
        ActivityLog::create($activity);
        return redirect()->route('menu.index')->with('success', 'Data menu berhasil dihapus.');
    }
}
