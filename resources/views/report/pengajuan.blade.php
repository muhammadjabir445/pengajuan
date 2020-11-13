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
        <p class="judul">FORMULIR PENGAJUAN PENGADAAN BARANG</p>
        <br>
        <p class="nomor">{{$data->nomor_surat}}</p>
        <br>
        <p>Tanggal Pengajuan : Jakarta, {{$data->tanggal_pengajuan->format('d F Y')}}</p>
        <table width="100%" class="table">
            <thead>
                <tr>
                    <th>NOMOR</th>
                    <th>JENIS KEBUTUHAN</th>
                    <th>JUMLAH</th>
                    <th>TUJUAN PENGADAAN</th>
                    <th>KETERANGAN</th>
                    <th>HARGA</th>
                    <th>ESTIMASI HARGA</th>
                </tr>
            </thead>
            <tbody>
                @php
                     $total_harga = 0;
                    $total_harga_detail = 0;
                @endphp
                @foreach ($data->detail as $index => $value)
                @php
                    $total_harga = $total_harga + $value->perkiraan_harga;
                     $total_harga_detail = $total_harga_detail + ($value->perkiraan_harga * $value->total);
                @endphp
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$value->barang->nama}}</td>
                    <td>{{$value->total}} / {{$value->barang->satuan_barang->description}}</td>
                    <td>{{$value->tujuan_pengadaan}}</td>
                    <td>{{$value->keterangan}}</td>
                    <td>Rp. {{number_format($value->perkiraan_harga,2)}}</td>
                    <td>Rp. {{number_format($value->perkiraan_harga * $value->total,2)}}</td>
                </tr>

                @endforeach
                <tr style="color: white;background-color:black">
                    <td colspan="5" style="text-align: center;">Jumlah</td>
                    <td>Rp. {{number_format($total_harga,2)}}</td>
                    <td>Rp. {{number_format($total_harga_detail,2)}}</td>
                </tr>

            </tbody>

        </table>

        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="2" style="background-color: black;color:white">Jakarta, {{$data->tanggal_pengajuan->format('d F Y')}}</td>
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
                    <td>{{\Str::upper($data->user->name) }}</td>
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
