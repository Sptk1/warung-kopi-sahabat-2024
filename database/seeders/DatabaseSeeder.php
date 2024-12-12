<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Peran;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create();
        // Peran::factory(2)->create();
        Peran::create([
            'nama' => 'Admin',
        ]);
        Peran::create([
            'nama' => 'Kasir',
        ]);
        
        User::create([
            'nama' => 'Kasir',
            'username' => "kasir",
            'password' => Hash::make('password'),
            'foto_profil' => asset('kopi_tiam.jpg'),
            'id_peran' => 2,
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => "admin",
            'password' => Hash::make('password'),
            'foto_profil' => asset('kopi_tiam.jpg'),
            'id_peran' => 1,
        ]);

        // Menu::create([
        //     'nama' => 'Kopi Tiam',
        //     'id_kategori' => 4,
        //     'harga_modal' => 10000,
        //     'harga_jual' => 14000,
        //     'deskripsi' => 'Ini kopi tiam',
        //     'foto' => asset('kopi_tiam.jpg'),
        // ]);

        // Menu::create([
        //     'nama' => 'Nasing Goreng',
        //     'id_kategori' => 5,
        //     'harga_modal' => 10000,
        //     'harga_jual' => 14000,
        //     'deskripsi' => 'Ini nasi goreng',
        //     'foto' => asset('nasi_goreng.jpeg'),
        // ]);

        // Menu::create([
        //     'nama' => 'Tahu Crispy',
        //     'id_kategori' => 6,
        //     'harga_modal' => 10000,
        //     'harga_jual' => 14000,
        //     'deskripsi' => 'Ini tahu crispy',
        //     'foto' => Storage::url('tahu_crispy.jpeg'),
        // ]);
    }
}
