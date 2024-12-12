@extends('components.main')
@section('title')
    - Kelola Kategori
@endsection
@section('container')
    <h1 class="app-page-title mb-2">Kelola Kategori</h1>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('kategori.destroy') }}">
                        @csrf
                        @method('delete')
                        <div class="table-wrap">
                            <table class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoris as $kategori)
                                        <tr class="alert" role="alert">
                                            <td class="align-middle">
                                                <label class="checkbox-wrap checkbox-primary">
                                                    <input class="form-check-input text-info mt-0" type="checkbox"
                                                        name="kategoris[]" value="{{ $kategori->id }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <a href="{{ route('kategori.edit', $kategori->id) }}"
                                                    class="text-warning"><i
                                                        class="fa-regular fa-pen-to-square mb-1 ms-2"></i></a>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <div class="d-flex flex-column ms-4">
                                                    <span class="small">{{ $kategori->nama }}
                                                    </span>
                                                    <span class="small">Added: {{ $kategori->created_at->format('d/m/Y') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="small align-middle">
                                                {!! $kategori->deskripsi !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="select-all" id="select-all">
                                <label class="form-check-label" for="select-all">
                                    Select All
                                </label>
                            </div>
                            <button type="submit" class="btn btn-danger" id="button">
                                <i class="fa fa-trash"></i>
                                Delete Selected (<span id="selected-count">0</span>)
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        var checkboxes = document.getElementsByName('kategoris[]');
        var deleteBtn = document.querySelector('#button');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var selectedCount = document.querySelectorAll('input[name="kategoris[]"]:checked').length;
                document.getElementById('selected-count').textContent = selectedCount;
            });
        });

        document.getElementById('select-all').addEventListener('change', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = event.target.checked;
            });
            var selectedCount = event.target.checked ? checkboxes.length : 0;
            document.getElementById('selected-count').textContent = selectedCount;
        });

        deleteBtn.addEventListener('click', function(event) {
            var selectedUsers = document.querySelectorAll('input[name="kategoris[]"]:checked');
            var selectedCount = selectedUsers.length;

            if (selectedCount === 0) {
                event.preventDefault();
                alert('Silakan pilih setidaknya satu kategori untuk dihapus.');
            }
        });
    </script>
@endsection
