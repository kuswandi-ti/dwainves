<!DOCTYPE html>
<html>
<head>
    <title>RECEIVING REPORT</title>
    <link rel="stylesheet" href="{{ public_path('report-assets/style.css') }}">
</head>
<body>
    <!-- Header Table -->
    <div>
        <table width="100%">
            <tr>
                <td class="length-logo">
                    <div class="length-logo">
                        <img class="logo" src="{{ public_path('report-assets/logo.jpg') }}" />
                    </div>
                </td>
                <td class="length-title">
                    <h1>RECEIVING REPORT</h1>
                </td>
                <td class="length-qr">
                    <img src="<?= $qrcode; ?>" width="120px"/>
                </td>
            </tr>
            <tr>
                <td class="address" colspan="2">
                    JL. Pangkalan 1A, No. 18<br>
                    Narogong Bantar Gebang, Bekasi Barat 17151<br>
                    Phone : (021) 8255058, Fax : 021-56955665.
                </td>
                <td class="no-rr">
                    <p>No R.R : <?= $source; ?></p>
                </td>
            </tr>
        </table>
    </div>
    <!-- End Header Table -->
    <br>
    <!-- Supplier Data Table -->
    <table width="100%">
        <tr>
            <td class="length-sup1 header-box">
                Supplier :<br>
                {{ $nama_supplier }}<br>
                {{ $alamat }}<br>
                {{ $kota }}<br>
                UP : {{ $nama }}<br>
                TELP : {{ $tlp }}/ FAX : {{ $fax }}<br>
            </td>
            <td>
            </td>
            <td class="length-sup2 header-box">
                <table width="100%">
                    <tr>
                        <td style="width: 100px">
                            NO R.R
                        </td>
                        <td style="width: 10px">
                            :
                        </td>
                        <td>
                            {{ $rr }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tanggal R.R
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{ $tanggal }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            No. D.I
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{ $no_di }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tanggal D.I
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{ $tanggal_di }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tanggal Kirim
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{ $tanggal_kirim }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- End Supplier Data Table -->
    <br>
    <!-- Detail Table -->
    <table class="table-font" border="1" width="100%">
        <thead style="font-size:16px;font-weight:bold;text-align: center; background: #cbf122; color: rgb(0, 0, 0)">
            <tr>
                <td style="width:5%">
                    No
                </td>
                <td style="width:15%">
                    Kode Barang
                </td>
                <td style="width:60%">
                    Nama Barang
                </td>
                <td style="width:8%">
                    Satuan
                </td>
                <td style="width:12%">
                    Quantity
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">
                    1.
                </td>
                <td style="text-align: center">
                    {{ $kode_barang }}
                </td>
                <td>
                    &nbsp; {{ $nama_barang }}
                </td>
                <td style="text-align: center">
                    {{ $satuan }}
                </td>
                <td style="text-align: center">
                    {{ $qty }}
                </td>
            </tr>
        </tbody>
    </table>
    <!-- End Detail Table -->
    <br>
    <footer>
        <!-- Footer Table -->
        <table class="table-font" border="1" width="100%">
            <thead style="font-weight:bold;text-align: center">
                <tr>
                    <td colspan="2">
                        Supplier
                    </td>
                    <td colspan="2">
                        PT. Dasa Windu Agung
                    </td>
                    <td rowspan="2">
                        Ketarangan
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center">
                        Disiapkan
                    </td>
                    <td style="text-align: center">
                        Pengirim
                    </td>
                    <td style="text-align: center">
                        Diterima
                    </td>
                    <td style="text-align: center">
                        Disetujui
                    </td>
                </tr>
                <tr>
                    <td style="height:60px;text-align: center">
                    </td>
                    <td style="height:60px;text-align: center">
                    </td>
                    <td style="height:60px;text-align: center">
                    </td>
                    <td style="height:60px;text-align: center">
                    </td>
                    <td rowspan="2" style="height:60px;text-align: center">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">
                        &nbsp; Tgl : 
                    </td>
                    <td style="text-align: left">
                        &nbsp; Tgl : 
                    </td>
                    <td style="text-align: left">
                        &nbsp; Tgl : 
                    </td>
                    <td style="text-align: left">
                        &nbsp; Tgl : 
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End Footer Table -->
    </footer>
</body>
</html>