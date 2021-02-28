<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h5>Laporan Total</h4>
    </center>

    <table class='table table-bordered table-sm'>
        <thead>
            <tr>
                <th>#</th>
                <th>Order</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Ongkir</th>
                <th>Diskon</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
            @foreach ($laptotal as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ number_format($p->totalorder,0,',','.') }}</td>
                    <td>{{ number_format($p->totalitem,0,',','.') }}</td>
                    <td>{{ number_format($p->qty,0,',','.') }}</td>
                    <td>{{ number_format($p->ongkir,0,',','.') }}</td>
                    <td>{{ number_format($p->diskon,0,',','.') }}</td>
                    <td>{{ number_format($p->pembayaran,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
