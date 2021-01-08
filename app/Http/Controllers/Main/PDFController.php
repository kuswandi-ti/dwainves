<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class PDFController extends Controller
{
    public function generate_pdf()
    {
        $path = 'qr-code/test.png';
        $file = $path;
        $source = "ABC123";
        $generate = \QRCode::text($source)->setOutfile($file)->png();
        $qrcode = $file;

        $pdf = PDF::loadView(
            'report.generate',
            [
                'nama_supplier' => 'PT. GOHAN PLASTINDO SUSES MANDIRI',
                'alamat'        => 'The City Resort Residence, komplek rukan miami blok A No. 25 RT.007 RW 001',
                'kota'          => 'Cengkareng Timur',
                'nama'          => 'Bpk. Antony',
                'tlp'           => '021-123123',
                'fax'           => '021-123123',

                // Data Report
                'rr'            => 'RR-20/10-0001',
                'tanggal'       => '15 Oktober 2020',
                'no_di'         => 'DI-2010-00001',
                'tanggal_di'    => '10 Oktober 2020',
                'tanggal_kirim' => '15 Oktober 2020',

                // Data Item
                'kode_barang'   => 'MPLPTPR000',
                'nama_barang'   => 'PLASTEIK, GRANULE TPV',
                'satuan'        => 'KG',
                'qty'           => '400',
                'qrcode'        => $qrcode,
                'source'        => $source
            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream('laporan.pdf');
        // return $pdf->download('laporan-pdf.pdf');
    }

    public function receiving_print()
    {
        $path = 'qr-code/test.png';
        $file = $path;
        $source = "ABC123";
        $generate = \QRCode::text($source)->setOutfile($file)->png();
        $qrcode = $file;

        $pdf = PDF::loadView(
            'report.receiving-report',
            [
                'nama_supplier' => 'PT. GOHAN PLASTINDO SUSES MANDIRI',
                'alamat'        => 'The City Resort Residence, komplek rukan miami blok A No. 25 RT.007 RW 001',
                'kota'          => 'Cengkareng Timur',
                'nama'          => 'Bpk. Antony',
                'tlp'           => '021-123123',
                'fax'           => '021-123123',

                // Data Report
                'rr'            => 'RR-20/10-0001',
                'tanggal'       => '15 Oktober 2020',
                'no_di'         => 'DI-2010-00001',
                'tanggal_di'    => '10 Oktober 2020',
                'tanggal_kirim' => '15 Oktober 2020',

                // Data Item
                'kode_barang'   => 'MPLPTPR000',
                'nama_barang'   => 'PLASTEIK, GRANULE TPV',
                'satuan'        => 'KG',
                'qty'           => '400',
                'qrcode'        => $qrcode,
                'source'        => $source
            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream('laporan.pdf');
        // return $pdf->download('laporan-pdf.pdf');
    }

    public function receiving_retur_print()
    {
        $path = 'qr-code/test.png';
        $file = $path;
        $source = "ABC123";
        $generate = \QRCode::text($source)->setOutfile($file)->png();
        $qrcode = $file;

        $pdf = PDF::loadView(
            'report.receiving-report-retur',
            [
                'nama_supplier' => 'PT. GOHAN PLASTINDO SUSES MANDIRI',
                'alamat'        => 'The City Resort Residence, komplek rukan miami blok A No. 25 RT.007 RW 001',
                'kota'          => 'Cengkareng Timur',
                'nama'          => 'Bpk. Antony',
                'tlp'           => '021-123123',
                'fax'           => '021-123123',

                // Data Report
                'rr'            => 'RR-20/10-0001',
                'tanggal'       => '15 Oktober 2020',
                'no_di'         => 'DI-2010-00001',
                'tanggal_di'    => '10 Oktober 2020',
                'tanggal_kirim' => '15 Oktober 2020',

                // Data Item
                'kode_barang'   => 'MPLPTPR000',
                'nama_barang'   => 'PLASTEIK, GRANULE TPV',
                'satuan'        => 'KG',
                'qty'           => '400',
                'qrcode'        => $qrcode,
                'source'        => $source
            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream('laporan.pdf');
        // return $pdf->download('laporan-pdf.pdf');
    }

    public function generate_qr()
    {
        $path = public_path('qr-code/Test.png');
        $file = $path;
        $generate = \QrCode::text('Test Program')->setOutfile($file)->png();
        $source = $file;

        // $data['qrcode'] = $source;
        $pdf = PDF::loadView('report.qr', $source)->setPaper('A4', 'potrait');;
        return $pdf->stream('qr.pdf');
    }

    public function receiving_certificate()
    {
        $pdf = PDF::loadView(
            'report.receiving-certificate',
            [
                // Header Data //
                'nama_supplier' => 'PT. GOHAN PLASTINDO SUSES MANDIRI',
                'date'          => '30 Oktober 2020',

                // Detail Data //
                'cert_id'       => 'COI0001',
                'inv_1'         => 'GPI-001',
                'inv_2'         => 'GPI-002',
                'inv_3'         => 'GPI-003',
                'inv_date1'     => '27 Oktober 2020',
                'inv_date2'     => '28 Oktober 2020',
                'inv_date3'     => '29 Oktober 2020',
                'amount1'       => '1.100.000',
            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream('laporan.pdf');
        // return $pdf->download('laporan-pdf.pdf');
    }

    public function certificate_invoice()
    {
        $path = 'qr-code/certificate.png';
        $file = $path;
        $source = "certificate";
        $generate = \QRCode::text($source)->setOutfile($file)->png();
        $qrcode = $file;

        $pdf = PDF::loadView(
            'report.certificate-invoice',
            [
                'nama_supplier' => 'PT. GOHAN PLASTINDO SUSES MANDIRI',
                'alamat'        => 'The City Resort Residence, komplek rukan miami blok A No. 25 RT.007 RW 001',
                'kota'          => 'Cengkareng Timur',
                'nama'          => 'Bpk. Antony',
                'tlp'           => '021-123123',
                'fax'           => '021-123123',

                // Data Report
                'rr'            => 'RR-20/10-0001',
                'tanggal'       => '15 Oktober 2020',
                'no_di'         => 'DI-2010-00001',
                'tanggal_di'    => '10 Oktober 2020',
                'tanggal_kirim' => '15 Oktober 2020',

                // Data Item
                'kode_barang'   => 'MPLPTPR000',
                'nama_barang'   => 'PLASTEIK, GRANULE TPV',
                'satuan'        => 'KG',
                'qty'           => '400',
                'qrcode'        => $qrcode,
                'source'        => $source
            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream('laporan.pdf');
        // return $pdf->download('laporan-pdf.pdf');
    }
}
