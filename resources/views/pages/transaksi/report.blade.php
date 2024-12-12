<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logofood.ico') }}">
    <title>Warung Kopi Sahabat - Laporan</title>

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.2.1-web/css/all.css') }}">>
</head>

<body>
    <div class="container">
        <div class="row my-5 d-flex flex-column justify-content-between">
            <div class="col d-flex flex-column align-items-center">
                <img src="/images/logofood.png" class="mb-3" alt="" srcset="" width="60">
                <h2>Warung Kopi Sahabat</h2>
                <p class="mb-1 text-center">Jl. Danau Sentarum No.5, Sungai Bangkong, Kec. Pontianak Kota, Kota
                    Pontianak,
                    Kalimantan Barat 78113</p>
            </div>
            <hr class="mt-3" style="border: 2px solid black;">
            <div class="col my-5">
                <h3 class="text-center">Laporan Transaksi</h3>
                <p class="mb-0 text-center">
                    {{ isset($_GET['month']) && isset($_GET['year']) ? 'Transaksi pada bulan ' . strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)) . ' ' . $_GET['year'] : (isset($_GET['month']) ? 'Transaksi pada bulan ' . strftime('%B', mktime(0, 0, 0, $_GET['month'], 1)) : (isset($_GET['year']) ? 'Transaksi pada tahun ' . $_GET['year'] : (isset($_GET['data']) && $_GET['data'] == 'all' ? 'Semua Transaksi' : (isset($_GET['data']) && $_GET['data'] == 'today' ? 'Transaksi hari ini' : (isset($_GET['data']) && $_GET['data'] == 'thisMonth' ? 'Transaksi bulan ini' : 'bau'))))) }}
                </p>
            </div>
        </div>
        <table class="table my-5">
            <thead>
                <tr>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Menu</th>
                    <th scope="col">No. Meja</th>
                    <th scope="col">Total Transaksi</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">Profit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $profit = [];
                    $profit_items = 0;
                @endphp
                @foreach ($data as $item)
                    @php
                        foreach ($item->detailTransaksis as $key) {
                            $profit_items += ($key->menu->harga_jual - $key->menu->harga_modal) * $key->jumlah;
                        }
                        $profit[] = $profit_items;

                        $total_profit = array_reduce($profit, 'myfunction');
                    @endphp
                    <tr>
                        <th scope="row">{{ $item->created_at->format('d M Y') }}</th>
                        <td class="w-50">
                            @foreach ($item->detailTransaksis as $el)
                                {{ $el->menu->nama . ',' }}
                            @endforeach
                        </td>
                        <td>{{ $item->meja->nama }}</td>
                        <td>Rp. {{ number_format($item->total_transaksi, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($profit_items, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @php
                    $arr_transaction = [];

                    foreach ($data as $item) {
                        $arr_transaction[] = $item->total_transaksi;
                    }

                    function myfunction($v1, $v2)
                    {
                        return $v1 + $v2;
                    }

                    $total_transaksi = array_reduce($arr_transaction, 'myfunction');
                @endphp
                <tr>
                    <th colspan="5" class="text-end">Total Transaksi</th>
                    <td>Rp. {{ number_format($total_transaksi, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th colspan="5" class="text-end">Total Profit</th>
                    <td>Rp. {{ number_format($total_profit, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
</body>

</html>
