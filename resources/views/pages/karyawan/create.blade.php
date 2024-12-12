@extends('components.main')
@section('title')
    - Tambah Karyawan Baru
@endsection
@section('container')
    <h1 class="app-page-title mb-4">Tambah Karyawan Baru</h1>
    <div class="col-12 col-md-8">
        <div class="app-card-body">
            <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="setting-input-2" class="form-label">Username <span class="ms-2"></span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="setting-input-2"
                        name="username" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Password</label>
                    <div class="input-group d-flex align-items-center" id="show_hide_password">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                            required>
                        <div class="input-group-addon">
                            <a href="" class="bg-white p-2 border rounded-end">
                                <i class="fa-solid fa-eye-slash" id="icon-password" aria-hidden="true"></i>
                            </a>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="setting-input-4" class="form-label">Peran</label>
                    <select class="form-select @error('peran') is-invalid @enderror" id="setting-input-4" name="id_peran"
                        required>
                        <option selected disabled>- pilih peran -</option>
                        @foreach ($perans as $peran)
                            <option value="{{ $peran->id }}">{{ $peran->peran }}</option>
                        @endforeach
                    </select>
                    @error('peran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="img">Foto Profil</label>
                    <div class="img-area">
                        <img class="img-preview">
                        <input type="file" id="img" class="select-image @error('foto_profil') is-invalid @enderror"
                            name="foto_profil">
                        <div class="view-path-img" data-path="false">
                            <h3>Foto Profil</h3>
                            <p>Ukuran foto profil harus lebih kecil dari <span>2MB</span></p>
                        </div>
                        @error('foto_profil')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn app-btn-primary w-100">Tambah</button>
            </form>
        </div>
    </div>

    <script>
        const img = document.getElementById('img');
        const img_preview = document.querySelector('.img-preview');
        const view_path_img = document.querySelector('.view-path-img');
        const select_image = document.querySelector('.select-image');

        img.addEventListener('change', function() {
            const files = img.files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                img_preview.src = this.result;
                img_preview.style.opacity = '1';
                view_path_img.innerHTML = ` <h3>${files.name}</h3> <p>click to change</p>`;
                view_path_img.setAttribute('data-path', 'true');
            });
        });
    </script>
@endsection
