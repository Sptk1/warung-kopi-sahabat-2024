@extends('components.main')
@section('title')
    - Edit Kategori
@endsection
@section('container')
    <h1 class="app-page-title mb-4">Edit Kategori</h1>
    <div class="col-12 col-md-8">
        <div class="app-card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">Nama <span class="ms-2"></span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="setting-input-1"
                        name="nama" value="{{ old('nama', $kategori->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input id="deskripsi" type="hidden" name="deskripsi"
                        value="{{ old('deskripsi', $kategori->deskripsi) }}">
                    <trix-editor input="deskripsi"></trix-editor>
                    @error('deskripsi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn app-btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
@endsection
