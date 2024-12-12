@extends('components.main')

@section('container')
    <div class="col-12 ">
        <form action="{{ route('profil.update_profil', $user->id) }}" method="POST"
            class="app-card app-card-account shadow-sm d-flex flex-column align-items-start" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="app-card-body px-4 w-100">
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label mb-2"><strong>Photo</strong></div>
                            <div class=""><img class="profile-image rounded-circle"
                                    src="{{ asset('storage/' . $user->foto_profil) }}" alt=""></div>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <div class="btn-sm file-input-custom">
                                <input class="file-input-customize" type="file" name="foto_profil" id="picture">
                                Change
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label><strong>Nama</strong></label>
                    <div class="input-group d-flex align-items-center" id="show_hide_password">
                        <input class="form-control @error('nama') is-invalid @enderror" type="nama" name="nama"
                            value="{{ old('nama', $user->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label><strong>Username</strong></label>
                    <div class="input-group d-flex align-items-center" id="show_hide_password">
                        <input class="form-control @error('username') is-invalid @enderror" type="username" name="username"
                            value="{{ old('username', $user->username) }}">
                        @error('username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label><strong>Password Baru</strong></label>
                    <div class="input-group d-flex align-items-center" id="show_hide_password">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password">
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
            </div>
            <div class="app-card-footer p-4 mt-auto">
                <button type="submit" class="btn btn-success text-white">Save Change</button>
                <a class="btn btn-danger text-white" href="">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        const picture = document.getElementById('picture');
        const profile_image = document.querySelector('.profile-image');

        picture.addEventListener('change', function() {
            const files = picture.files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                profile_image.src = this.result;
            });
        });
    </script>
@endsection
