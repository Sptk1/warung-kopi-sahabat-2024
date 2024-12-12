@extends('components.main')
@section('title')
    - Tambah Kategori Baru
@endsection
@section('container')
    <h1 class="app-page-title mb-4">Tambah Kategori Baru</h1>
    <div class="col-12 col-md-8">
        <div class="app-card-body">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">Nama <span class="ms-2"></span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="setting-input-1"
                        name="nama" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input id="deskripsi" type="hidden" name="deskripsi">
                    <trix-editor input="deskripsi"></trix-editor>
                    @error('deskripsi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn app-btn-primary w-100">Tambah</button>
            </form>
        </div>
    </div>
@endsection
