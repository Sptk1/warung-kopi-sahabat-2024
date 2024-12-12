@extends('components.main')
@section('title')
    - Edit Karyawan
@endsection
@section('container')
    <h1 class="app-page-title mb-4">Edit Karyawan</h1>
    <div class="col-12 col-md-8">
        <div class="app-card-body">
            <form action="{{ route('karyawan.update', $user->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">Nama <span class="ms-2"></span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="setting-input-1"
                        name="nama" value="{{ old('nama', $user->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="setting-input-2" class="form-label">Username <span class="ms-2"></span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="setting-input-2"
                        name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="setting-input-4" class="form-label">Peran</label>
                    <select class="form-select @error('id_peran') is-invalid @enderror" id="setting-input-4" name="id_peran"
                        required>
                        @foreach ($perans as $peran)
                            <option value="{{ $peran->id }}" @if (old('id_peran', $user->id_peran) == $peran->id) selected @endif>
                                {{ $peran->peran }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_peran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn app-btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
@endsection
