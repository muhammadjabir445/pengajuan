<?php

namespace App\Services;

use App\Models\Pembelian;
use PDF;
use Response;
class ReportPembelianService {
    public static function data($id){
        $data = Pembelian::with(['detail.barang.satuan_barang','detail.pengajuan','pengajuan.user'])->findOrFail($id);
        return $data;
    }

    public static function report_pdf($data){
        $pdf = PDF::loadView('report.pembelian',['data'=>$data]);

        return $pdf->download('invoice.pdf');
    }
    public static function report_excel($data){
        $file_template = public_path('storage/pengajuan');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_template . '/template_report_pembelian.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $_number = 1;
        $_row = 10;
        $worksheet->getCell('A7')->setValue("Tanggal Pengajuan : {$data->pengajuan->tanggal_pengajuan->format('d, M Y')}");
        $worksheet->getCell('A6')->setValue("Nomor : $data->nomor_surat");
        $total_harga = 0;
        $total_harga_detail = 0;
        $real_total = 0;
        $real_total_detail = 0;
        foreach ($data->detail as $value) {
            $total_harga =$total_harga + $value->pengajuan->perkiraan_harga;
            $total_harga_detail =$total_harga_detail + ($value->pengajuan->perkiraan_harga * $value->pengajuan->total);
            $real_total = $real_total + $value->harga;
            $real_total_detail = $real_total_detail + ($value->harga * $value->pengajuan->total);
            $worksheet->getCell('A' .$_row)->setValue($_number);
            $worksheet->getCell('B' .$_row)->setValue("{$value->barang->nama}");
            $worksheet->getCell('C' .$_row)->setValue("{$value->pengajuan->total} / {$value->barang->satuan_barang->description}");
            $worksheet->getCell('D' .$_row)->setValue("Rp. " . number_format($value->pengajuan->perkiraan_harga,2));
            $worksheet->getCell('E' .$_row)->setValue("Rp. " . number_format($value->pengajuan->perkiraan_harga * $value->pengajuan->total,2));
            $worksheet->getCell('F' .$_row)->setValue("Rp. " . number_format($value->harga,2));
            $worksheet->getCell('G' .$_row)->setValue("Rp. " . number_format($value->harga * $value->pengajuan->total,2));
            $worksheet->getCell('H' .$_row)->setValue("Rp. " . number_format($total_harga - $real_total,2));
            $worksheet->getCell('I' .$_row)->setValue("Rp. " . number_format($total_harga_detail - $real_total_detail,2));
            // $worksheet->getCell('H' .$_row)->setValue("TEST");
            $_number++;
            $_row++;

        }
        $worksheet->getStyle("A10:I$_row")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffffff');
        $worksheet->getStyle("A10:I$_row")->applyFromArray($styleArray);
        $worksheet->getStyle("A10:I$_row")->getAlignment()->setWrapText(true);
        $worksheet->getCell('A' .$_row)->setValue('Jumlah');
        $worksheet->getCell('D' .$_row)->setValue("Rp. " . number_format($total_harga,2));
        $worksheet->getCell('E' .$_row)->setValue("Rp. " . number_format($total_harga_detail,2));
        $worksheet->getCell('F' .$_row)->setValue("Rp. " . number_format($real_total,2));
        $worksheet->getCell('G' .$_row)->setValue("Rp. " . number_format($real_total_detail,2));
        $worksheet->getCell('H' .$_row)->setValue("Rp. " . number_format($total_harga - $real_total,2));
        $worksheet->getCell('I' .$_row)->setValue("Rp. " . number_format($total_harga_detail - $real_total_detail,2));
        $worksheet->mergeCells("A$_row:C$_row");
        $worksheet->getStyle("A$_row:I$_row")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $worksheet->getStyle("A$_row:I$_row")->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

        // ttd
        $row_ttd = $_row +2;
        $worksheet->getCell('A'.$row_ttd)->setValue("{$data->pengajuan->tanggal_pengajuan->format('d, M Y')}");
        $worksheet->mergeCells("A$row_ttd:I$row_ttd");
        $worksheet->getStyle("A$row_ttd:I$row_ttd")->applyFromArray($styleArray);
        $worksheet->getStyle("A$row_ttd:I$row_ttd")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $worksheet->getStyle("A$row_ttd:I$row_ttd")->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

        $row_ttd++;
        $new_style = [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ];
        $styleArray['borders'] = $new_style;
        $end_row = $row_ttd + 8;
        $worksheet->getStyle("A$row_ttd:I$end_row")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffffff');
        $worksheet->getStyle("A$row_ttd:I$end_row")->getAlignment()->setWrapText(true);
        $worksheet->getStyle("A$row_ttd:I$end_row")->applyFromArray($styleArray);
        $worksheet->getCell('B'.$row_ttd)->setValue("Pemohon");
        $worksheet->getCell('G'.$row_ttd)->setValue("Disetujui");
        $row_ttd = $row_ttd + 3;
        $worksheet->getCell('B'.$row_ttd)->setValue($data->pengajuan->user->name);
        $worksheet->getCell('G'.$row_ttd)->setValue("Mila");
        $row_ttd = $row_ttd + 2;
        $worksheet->getCell('A'.$row_ttd)->setValue("Diketahui");
        $worksheet->mergeCells("A$row_ttd:I$row_ttd");
        $row_ttd = $row_ttd + 2;
        $worksheet->mergeCells("A$row_ttd:I$row_ttd");
        $worksheet->getCell('A'.$row_ttd)->setValue("Juli");
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($file_template. '/pembelian.xlsx');
        $headers = array(
            'Content-Type: application/vnd.ms-excel',
            );
        return Response::download($file_template . '/pembelian.xlsx', "Report SPB $data->tanggal_pengajuan.XLSX", $headers);
    }

}
