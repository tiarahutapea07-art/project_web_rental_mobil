<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            font-size: 13px;
            color: #000;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            font-size: 26px;
            font-weight: bold;
        }

        .box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .col {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #000;
        }

        th {
            background: #eee;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- HEADER -->
    <div class="header">
        <div>
            <strong>RENTAL MOBIL</strong><br>
            Palembang
        </div>

        <div class="title">
            NOTA
        </div>
    </div>

    <!-- INFO -->
    <div class="box">
        <div class="row">
            <div class="col">
                Nota No : DCR-{{ $transaksi->id }}<br>

                Customer :
                {{ optional($transaksi->rental->customer)->nama ?? '-' }}<br>

                Tgl Order :
                {{ optional($transaksi->rental->tanggal_sewa) 
                    ? date('d/m/Y', strtotime($transaksi->rental->tanggal_sewa)) 
                    : '-' }}<br>

                Pembayaran :
                {{ strtoupper($transaksi->metode_bayar ?? 'CASH') }}
            </div>

            <div class="col text-right">
                RENTAL MOBIL <br>
                (Menyediakan Sewa Mobil)<br>
                Phone : 0812-3456-7890
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    Sewa Mobil<br>
                    {{ optional($transaksi->rental->mobil)->nama_mobil ?? '-' }}<br>
                    {{ optional($transaksi->rental)->lama_sewa ?? 0 }} Hari<br>

                    {{ optional($transaksi->rental->tanggal_sewa)
                        ? date('d/m/Y', strtotime($transaksi->rental->tanggal_sewa))
                        : '-' }}
                    -
                    {{ optional($transaksi->rental->tanggal_kembali)
                        ? date('d/m/Y', strtotime($transaksi->rental->tanggal_kembali))
                        : '-' }}
                </td>

                <td class="text-right">
                    Rp {{ number_format(optional($transaksi->rental)->total_harga ?? 0, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>

        <tr>
            <td style="width:70%;">
                <strong>Terbilang:</strong>
                <i>{{ $terbilang ?? '-' }}</i>
            </td>

            <td class="text-right" style="width:30%;">
                <strong>Total IDR</strong><br>
                Rp {{ number_format(optional($transaksi->rental)->total_harga ?? 0, 0, ',', '.') }}
            </td>
        </tr>
    </table>

</body>
</html>
