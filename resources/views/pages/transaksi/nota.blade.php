<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logofood.ico') }}">
    <title>Warung Kopi Sahabat - Nota Transaksi</title>

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.2.1-web/css/all.css') }}">>
</head>

<body>
    <div class="card">
        <div class="card-body mx-4">
            <div class="container">
                <p class="my-5 mb-0 text-center" style="font-size: 30px;">Warung Kopi Sahabat</p>
                <p class="mt-0 mb-1 text-center" style="font-size: 15px;">Jl. Danau Sentarum No.5, Sungai Bangkong, Kec.
                    Pontianak Kota, Kota Pontianak, Kalimantan Barat 78113</p>
                @foreach ($data as $key)
                    @php
                        $datetime = explode(' ', $key->created_at)[0];
                        $date = \Carbon\Carbon::parse($datetime);

                        $times_ex = explode(' ', $key->created_at)[1];
                        $times = \Carbon\Carbon::parse($times_ex);
                        $time = explode(' ', $times->toDayDateTimeString());
                    @endphp
                    <div class="row">
                        <ul class="list-unstyled">
                            <li class="text-black">Kasir &nbsp : &nbsp{{ $key->user->nama }}</li>
                            <span class="text-black">No. Meja: {{ $key->meja->nama }}</span>
                            <li class="text-black mt-1">Tanggal &nbsp : &nbsp {{ $date->toFormattedDateString() }}
                                {{ $time[4] . ' ' . $time[5] }}</li>
                        </ul>
                        <hr>
                        @foreach ($key->detailTransaksis as $item)
                            <div class="col-xl-10">
                                <p class="mb-0">{{ $item->menu->nama }}</p>
                                <p class="small text-muted">{{ $item->jumlah }} x {{ $item->menu->harga_jual }}</p>
                            </div>
                            <div class="col-xl-2">
                                <p class="float-end">
                                    {{ number_format($item->transaksi->total_transaksi, 0, ',', '.') }}</p>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="row text-black">
                        @php
                            $arr = [];
                            foreach ($key->detailTransaksis as $item) {
                                $arr[] = $item->harga;
                            }

                            function myfunction($v1, $v2)
                            {
                                return $v1 + $v2;
                            }

                            $total = array_reduce($arr, 'myfunction');
                        @endphp

                        <div class="col-xl-12">
                            <p class="float-end fw-bold">Total &nbsp: &nbsp
                                {{ number_format($key->total_transaksi, 0, ',', '.') }}</p>
                        </div>
                        <hr style="border: 2px solid black;">
                        <div class="col-xl-12">
                            <p class="float-end fw-bold total-payment" id="total_pembayaran">Total Pembayaran &nbsp:
                                &nbsp {{ number_format($key->total_pembayaran, 0, ',', '.') }}
                                <span class="change"></span>
                            </p>
                        </div>
                        <div class="col-xl-12">
                            <p class="float-end fw-bold" id="kembalian">Kembalian &nbsp: &nbsp
                                {{ number_format($key->total_kembalian, 0, ',', '.') }}
                                <span class="change"></span>
                            </p>
                        </div>
                    </div>
                @endforeach
                <div class="text-center" style="margin-top: 90px;">
                    <p class="mb-0 d-flex align-items-center justify-content-center"><u
                            class="text-info text-decoration-none"><img src="{{ asset('assets/images/logofood.png') }}"
                                alt="" srcset="" width="20">Warung Kopi Sahabat</u></p>
                    <p>Thanks for joining us at Warung Kopi Sahabat. </p>
                </div>

            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            // Ambil data dari localStorage
            const totalPembayaran = localStorage.getItem('total_pembayaran');
            const kembalian = localStorage.getItem('kembalian');

            // Masukkan data ke elemen HTML
            if (totalPembayaran) {
                document.getElementById('total_pembayaran').textContent = "Total Pembayaran: " + totalPembayaran;
            }
            if (kembalian) {
                document.getElementById('kembalian').textContent = "Total Kembalian: " + kembalian;
            }

            // Hapus data dari localStorage setelah digunakan (opsional)
            localStorage.removeItem('total_pembayaran');
            localStorage.removeItem('kembalian');

            // Cetak halaman setelah data terisi
            window.print();
        };
    </script>
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>

</body>

</html>
