<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container{
            padding: 20px;
            text-align: center;
            width: 100%;
        }
        .judul {
            font-size: 16px;
            text-align: center;
            font-weight: bold
        }
        .nomor {
            font-size: 16px;
            text-align: center;

        }
        tr th,tr td {
            padding: 5px;
            font-size: 11px;
            text-align: center
        }
        .table,.table tr th,.table tr td {
            border: 1px black solid;
            border-collapse: collapse
        }
    </style>
</head>
<body>
    <div class="conitaner" style="">
        {{-- <img src="{{ public_path('laporan.jpg') }}" alt=""> --}}
        <p class="judul">FORMULIR SURAT PEMBELIAN BARANG</p>
        <br>
        <p class="nomor">{{$data->nomor_surat}}</p>
        <br>
        <p>Tanggal Pengajuan : Jakarta, {{$data->pengajuan->tanggal_pengajuan->format('d F Y')}}</p>
        <table width="100%" class="table">
            <thead>
                <tr>
                    <th>NOMOR</th>
                    <th>BARANG</th>
                    <th>TOTAL</th>
                    <th>ESTIMASI HARGA</th>
                    <th>JUMLAH ESTIMASI</th>
                    <th>HARGA</th>
                    <th>JUMLAH HARGA</th>
                    <th>SELISI</th>
                    <th>JUMLAH SELESI</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total_harga = 0;
                $total_harga_detail = 0;
                $real_total = 0;
                $real_total_detail = 0;
                @endphp
                @foreach ($data->detail as $index => $value)
                @php
                     $total_harga =$total_harga + $value->pengajuan->perkiraan_harga;
                    $total_harga_detail =$total_harga_detail + ($value->pengajuan->perkiraan_harga * $value->pengajuan->total);
                    $real_total = $real_total + $value->harga;
                    $real_total_detail = $real_total_detail + ($value->harga * $value->pengajuan->total);
                @endphp
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$value->barang->nama}}</td>
                    <td>{{$value->pengajuan->total}} / {{$value->barang->satuan_barang->description}}</td>
                    <td>Rp. {{number_format($value->pengajuan->perkiraan_harga,2)}}</td>
                    <td>Rp. {{number_format($value->pengajuan->perkiraan_harga * $value->pengajuan->total,2)}}</td>
                    <td>Rp. {{number_format($value->harga,2)}}</td>
                    <td>Rp. {{number_format($value->harga * $value->pengajuan->total,2)}}</td>
                    <td>Rp. {{number_format($total_harga - $real_total,2)}}</td>
                    <td>Rp. {{number_format($total_harga_detail - $real_total_detail,2)}}</td>
                </tr>

                @endforeach
                <tr style="color: white;background-color:black">
                    <td colspan="3" style="text-align: center;">Jumlah</td>
                    <td>Rp. {{number_format($total_harga,2)}}</td>
                    <td>Rp. {{number_format($total_harga_detail,2)}}</td>
                    <td>Rp. {{number_format($real_total,2)}}</td>
                    <td>Rp. {{number_format($real_total_detail,2)}}</td>
                    <td>Rp. {{number_format($total_harga - $real_total,2)}}</td>
                    <td>Rp. {{number_format($total_harga_detail - $real_total_detail,2)}}</td>
                </tr>

            </tbody>

        </table>

        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="2" style="background-color: black;color:white">Jakarta, {{$data->pengajuan->tanggal_pengajuan->format('d F Y')}}</td>
                </tr>
                <tr>
                    <td>Pemohon</td>
                    <td>Disetujui</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td>{{\Str::upper($data->pengajuan->user->name) }}</td>
                    <td>HIMATUL MILA</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2">Diketahui</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2">JULI HERMANSYAH</td>
                </tr>
            </tbody>
        </table>


    </div>
</body>
</html>
