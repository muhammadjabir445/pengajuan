<?php
namespace App\Services;

use App\Models\ParentPengajuan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;
use Response;

Class ReportPengajuanService{
    public static function data($id) {
        $data = ParentPengajuan::with(['detail'=>function($q) {
            return $q->with('barang.satuan_barang')->where('status_pengajuan',3);
        },'user'])->findOrFail($id);
        return $data;
    }
    public static function report_pdf($data){
        $pdf = PDF::loadView('report.pengajuan',['data'=>$data]);

        return $pdf->download('invoice.pdf');
    }
    public static function report_excel($data) {
        $file_template = public_path('storage/pengajuan');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_template . '/template_report_pengajuan.xlsx');
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
        $worksheet->getCell('A7')->setValue("Tanggal Pengajuan : {$data->tanggal_pengajuan->format('d, M Y')}");
        $worksheet->getCell('A6')->setValue("Nomor : $data->nomor_surat");
        $total_harga = 0;
        $total_harga_detail = 0;
        foreach ($data->detail as $value) {
            $worksheet->getCell('A' .$_row)->setValue($_number);
            $worksheet->getCell('B' .$_row)->setValue("{$value->barang->nama}");
            $worksheet->getCell('C' .$_row)->setValue("$value->total / {$value->barang->satuan_barang->description}");
            $worksheet->getCell('D' .$_row)->setValue("$value->tujuan_pengadaan");
            $worksheet->getCell('E' .$_row)->setValue("$value->keterangan");
            $worksheet->getCell('F' .$_row)->setValue("Rp. " . number_format($value->perkiraan_harga,2));
            $worksheet->getCell('G' .$_row)->setValue("Rp. " . number_format($value->perkiraan_harga * $value->total,2));
            // $worksheet->getCell('H' .$_row)->setValue("TEST");
            $_number++;
            $_row++;
            $total_harga =$total_harga + $value->perkiraan_harga;
            $total_harga_detail =$total_harga_detail + ($value->perkiraan_harga * $value->total);
        }
        $worksheet->getStyle("A10:H$_row")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffffff');
        $worksheet->getStyle("A10:H$_row")->applyFromArray($styleArray);
        $worksheet->getStyle("A10:H$_row")->getAlignment()->setWrapText(true);
        $worksheet->getCell('A' .$_row)->setValue('Jumlah');
        $worksheet->getCell('F' .$_row)->setValue("Rp. " . number_format($total_harga,2));
        $worksheet->getCell('G' .$_row)->setValue("Rp. " . number_format($total_harga_detail,2));
        $worksheet->mergeCells("A$_row:E$_row");
        $worksheet->getStyle("A$_row:H$_row")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $worksheet->getStyle("A$_row:H$_row")->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

        // ttd
        $row_ttd = $_row +2;
        $worksheet->getCell('A'.$row_ttd)->setValue("{$data->tanggal_pengajuan->format('d, M Y')}");
        $worksheet->mergeCells("A$row_ttd:H$row_ttd");
        $worksheet->getStyle("A$row_ttd:H$row_ttd")->applyFromArray($styleArray);
        $worksheet->getStyle("A$row_ttd:H$row_ttd")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
        $worksheet->getStyle("A$row_ttd:H$row_ttd")->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

        $row_ttd++;
        $new_style = [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ];
        $styleArray['borders'] = $new_style;
        $end_row = $row_ttd + 8;
        $worksheet->getStyle("A$row_ttd:H$end_row")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffffff');
        $worksheet->getStyle("A$row_ttd:H$end_row")->getAlignment()->setWrapText(true);
        $worksheet->getStyle("A$row_ttd:H$end_row")->applyFromArray($styleArray);
        $worksheet->getCell('B'.$row_ttd)->setValue("Pemohon");
        $worksheet->getCell('G'.$row_ttd)->setValue("Disetujui");
        $row_ttd = $row_ttd + 3;
        $worksheet->getCell('B'.$row_ttd)->setValue($data->user->name);
        $worksheet->getCell('G'.$row_ttd)->setValue("Mila");
        $row_ttd = $row_ttd + 2;
        $worksheet->getCell('A'.$row_ttd)->setValue("Diketahui");
        $worksheet->mergeCells("A$row_ttd:H$row_ttd");
        $row_ttd = $row_ttd + 2;
        $worksheet->mergeCells("A$row_ttd:H$row_ttd");
        $worksheet->getCell('A'.$row_ttd)->setValue("Juli");
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($file_template. '/test.xlsx');
        $headers = array(
            'Content-Type: application/vnd.ms-excel',
            );
        return Response::download($file_template . '/test.xlsx', "Report PPB $data->tanggal_pengajuan.XLSX", $headers);
    }

}
