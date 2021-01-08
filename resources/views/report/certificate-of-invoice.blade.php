<!DOCTYPE html>
<html>
<head>
    <title>CERTIFICATE OF INVOICE</title>
    <link rel="stylesheet" href="{{ public_path('report-assets/style.css') }}">
</head>
<body>
    <!-- Header Table -->
    <div>
        <table width="100%">
            <tr>
                <td style="height:80px;width: 50%">
                    <div style="padding-top: -20px">
                    <img style="top:-30px;position:absolute" class="logo" src="{{ public_path('report-assets/logo.jpg') }}" />
                    <p style="top:12px;position:absolute;font-size:12px;font-weight:bold">PT. Dasa Windu Agung</p>
                    </div>
                </td>
                <td></td>
                <td style="text-align:right;font-weight: bold">
                    CERTIFICATE OF INVOICE
                </td>
            </tr>
        </table>
        <hr>
    </div>
    <!-- End Header Table -->
    <br>
    <!-- Supplier Data Table -->
    <table style="font-size: 12px" width="100%">
        <tr>
            <td style="width:15%">Supplier Code</td>
            <td style="width:5%">:</td>
            <td style="width:40%">{{ $data_hdr['vendor_code'] }}</td>
            <td style="width:5%"></td>
            <td style="width:35%;text-align: center" rowspan="3">
                <img style="position:absolute;top:110px;left:517px" src="<?= $qrcode; ?>" width="120px"/>
            </td>
        </tr>
        <tr>
            <td>Supplier Name</td>
            <td>:</td>
            <td>{{ $data_hdr['vendor_name'] }}</td>
            <td></td>
        </tr>
        <tr>
            <td style="vertical-align:top;height: 60px">NPWP No.</td>
            <td style="vertical-align:top;">:</td>
            <td style="vertical-align:top;">{{ $data_hdr['vendor_npwp'] }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align:center;font-weight:bold">
                Certification No. : {{ $data_hdr['coi_no'] }}
            </td>
        </tr>
    </table>
    <!-- End Supplier Data Table -->
    <br>
    <!-- Detail Table -->
    <table class="table-font" border="1" width="100%">
        <thead style="font-size:16px;font-weight:bold;text-align: center; background: #cbf122; color: rgb(0, 0, 0)">
            <tr>
                <td style="width:5%; text-align: center">
                    No
                </td>
                <td style="width:10%; text-align: center">
                    No. Invoice
                </td>
                <td style="width:15%; text-align: center">
                    Invoice Date
                </td>
                <td style="width:17%; text-align: center">
                    Faktur No
                </td>
                <td style="width:15%; text-align: center">
                    Faktur Date
                </td>
                <td style="width:12%; text-align: center">
                    DPP
                </td>
                <td style="width:12%; text-align: center">
                    PPN
                </td>
                <td style="width:14%; text-align: center">
                    Total
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
                        {{ $r->invoice_no }}
                    </td>
                    <td style="text-align: center">
                        {{ date('d-M-Y', strtotime($r->invoice_date)) }}
                    </td>
                    <td style="text-align: center">
                        {{ $r->faktur_name }}
                    </td>
                    <td style="text-align: center">
                        {{ date('d-M-Y', strtotime($r->faktur_date)) }}
                    </td>
                    <td style="text-align: center">
                        @currencyFormat($r->dpp)
                    </td>
                    <td style="text-align: center">
                        @currencyFormat($r->ppn)
                    </td>
                    <td style="text-align: center">
                        @currencyFormat($r->total)
                    </td>
                </tr>
                @php $i = $i+1 @endphp
            @endforeach
        </tbody>
    </table>
    <!-- End Detail Table -->

    <br>

    Detail DI<br>
    No. PLO : <b>{{ $data_hdr['coi_no'] }}</b>

    <br><br>

    <table class="table-font" border="1">
        <thead style="font-size:16px;font-weight:bold;text-align: center; background: #cbf122; color: rgb(0, 0, 0)">
            <tr>
                <td style="width:5px; text-align: center">
                    No
                </td>
                <td style="width:150px; text-align: center">
                    DI. No 
                </td>
                <td style="width:150px; text-align: center">
                    DI Date
                </td>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($data_sub_dtl as $r)
                <tr>
                    <td style="text-align: center">
                        {{ $i }}
                    </td>
                    <td style="text-align: center">
                        {{ $r->rdi_no }}
                    </td>
                    <td style="text-align: center">
                        {{ date('d-M-Y', strtotime($r->rdi_date)) }}
                    </td>
                </tr>
                @php $i = $i+1 @endphp
            @endforeach
        </tbody>
    </table>
    <footer>
        <!-- Footer Table -->
        <table align="right" class="table-font" border="1">
            <thead style="background:chartreuse;font-weight:bold;text-align: center">
                <tr>
                    <td style="text-align:center;width:170px">
                        Check by Supplier
                    </td>
                    <td style="text-align:center;width:170px">
                        Check by PT.DWA
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr style="">
                    <td style="height: 70px;text-align: center">
                    </td>
                    <td style="height: 70px;text-align: center">
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End Footer Table -->
    </footer>
</body>
</html>