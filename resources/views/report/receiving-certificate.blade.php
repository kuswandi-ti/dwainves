<!DOCTYPE html>
<html>
<head>
    <title>RECEIVING CERTIFICATE OF INVOICE</title>
    <link rel="stylesheet" href="{{ public_path('report-assets/style.css') }}">
</head>
<body>
    <!-- Header Table -->
    <div>
        <table width="100%">
            <tr>
                <td style="width: 20%">
                    <div class="length-logo">
                        <img class="logo" src="{{ public_path('report-assets/logo.jpg') }}" />
                    </div>
                </td>
                <td style="width: 80%">
                    <h1>RECEIVING CERTIFICATE OF INVOICE</h1>
                </td>
            </tr>
        </table>
    </div>
    <!-- End Header Table -->
    <br>
    <!-- Supplier Data Table -->
    <table width="100%">
        <tr>
            <td style="width: 15%">
                Supplier
            </td>
            <td style="width: 3%">
                :
            </td>
            <td style="width: 72%">
                {{ $nama_supplier }}
            </td>
        </tr>
        <tr>
            <td>
                Receiving Date
            </td>
            <td>
                :
            </td>
            <td>
                {{ $date }}
            </td>
        </tr>
    </table>
    <!-- End Supplier Data Table -->
    <br>
    <table class="table-font" border="1" width="100%">
        <thead style="font-size:16px;font-weight:bold;text-align: center; background: #cbf122; color: rgb(0, 0, 0)">
            <tr>
                <td style="width:5%">
                    No
                </td>
                <td style="width:15%">
                    Cert.ID No
                </td>
                <td style="width:15%">
                    Invoice No
                </td>
                <td style="width:15%">
                    Invoice Date
                </td>
                <td style="width:15%">
                    Amount
                </td>
                <td style="width:20%">
                    Maturity Date
                </td>
                <td style="width:15%">
                    Notes
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">
                    1.
                </td>
                <td style="text-align: center">
                    {{ $cert_id }}
                </td>
                <td>
                    &nbsp; {{ $inv_1 }}
                </td>
                <td style="text-align: right">
                    {{ $inv_date1 }}
                </td>
                <td style="text-align: right">
                    {{ $amount1 }}
                </td>
                <td style="text-align: right">
                    {{ $inv_date1 }}
                </td>
                <td style="text-align: right">
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    2.
                </td>
                <td style="text-align: center">
                    {{ $cert_id }}
                </td>
                <td>
                    &nbsp; {{ $inv_1 }}
                </td>
                <td style="text-align: right">
                    {{ $inv_date1 }}
                </td>
                <td style="text-align: right">
                    {{ $amount1 }}
                </td>
                <td style="text-align: right">
                    {{ $inv_date1 }}
                </td>
                <td style="text-align: right">
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    3.
                </td>
                <td style="text-align: center">
                    {{ $cert_id }}
                </td>
                <td>
                    &nbsp; {{ $inv_1 }}
                </td>
                <td style="text-align: right">
                    {{ $inv_date1 }}
                </td>
                <td style="text-align: right">
                    {{ $amount1 }}
                </td>
                <td style="text-align: right">
                    {{ $inv_date1 }}
                </td>
                <td style="text-align: right">
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <hr>
    <br>
    <table width="100%">
        <tr>
            <td style="text-align:center;width: 30%">
                Supplier
            </td>
            <td style="width: 40%">
            </td>
            <td style="text-align:center;width: 30%">
                Received By
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
            </td>
            <td style="text-align:center;">
                PT. Dasa Windu Agung
            </td>
        </tr>
        <tr>
            <td style="height: 100px">
            </td>
            <td style="height: 100px">
            </td>
            <td style="height: 100px">
                <div class="email-box">
                    <p style="color:rgb(14, 0, 207);">SEND EMAIL</p>
                    <img width="50px" src="{{ public_path('images/logo.jpg') }}"/>
                    <p style="color:rgb(14, 0, 207);">15 Oktober 2020</p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
            </td>
            <td>
            </td>
            <td>
                <hr>
            </td>
        </tr>
    </table>

</body>
</html>