<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    public function test_tambah_kategori_berhasil()
    {
        // Ambil admin dengan izin yang sesuai
        $admin = User::where('username', 'admin')->first();

        $data = [
            'nama' => 'Kategori Baru',
        ];

        // Simulasikan request menggunakan pengguna admin
        $response = $this->actingAs($admin)->post(route('kategori.store'), $data);

        // Periksa apakah redirect ke halaman kategori
        $response->assertRedirect(route('kategori.index'));

        // Periksa apakah pesan sukses ada di sesi
        $response->assertSessionHas('success', 'Kategori baru berhasil ditambahkan.');

        // Periksa apakah data tersimpan di database
        $this->assertDatabaseHas('kategoris', [
            'nama' => $data['nama'],
        ]);
    }


    public function test_tambah_kategori_gagal()
    {
        $admin = User::where('username', 'admin')->first();

        $data = [
            'nama' => '', // nama tidak diisi
        ];

        $response = $this->actingAs($admin)->json('POST', '/kategori/store', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'nama' => 'Nama wajib diisi.',
        ]);
    }
}
