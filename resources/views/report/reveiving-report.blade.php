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
                    <p>No R.R : {{ $data_hdr['rr_no'] }}</p>
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
                {{ $data_hdr['vendor_name'] }}<br>
                {{ $data_hdr['vendor_address'] }}<br>
                {{ $data_hdr['vendor_address_city'] }}<br>
                UP : {{ $data_hdr['vendor_person_name'] }}<br>
                TELP : {{ $data_hdr['vendor_phone'] }}/ FAX : {{ $data_hdr['vendor_fax'] }}<br>
            </td>
            <td>
            </td>
            <td class="length-sup2 header-box">
                <table width="100%">
                    <tr>
                        <td style="width: 100px">
                            NO R.R.
                        </td>
                        <td style="width: 10px">
                            :
                        </td>
                        <td>
                            {{ $data_hdr['rr_no'] }}
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
                            {{ $data_hdr['rr_date'] }}
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
                            {{ $data_hdr['rdi_no'] }}
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
                            {{ $data_hdr['rdi_date'] }}
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
                            {{ $data_hdr['delivery_date'] }}
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
            @php $i = 1 @endphp
            @foreach($data_dtl as $r)
                <tr>
                    <td style="text-align: center">
                        {{ $i }}
                    </td>
                    <td style="text-align: center">
                        {{ $r->pn_number }}
                    </td>
                    <td>
                        &nbsp; {{ $r->pn_name }}
                    </td>
                    <td style="text-align: center">
                        {{ $r->unit_name }}
                    </td>
                    <td style="text-align: center">
                        @currencyFormat($r->qty_rr)
                    </td>
                </tr>
                @php $i = $i+1 @endphp
            @endforeach            
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