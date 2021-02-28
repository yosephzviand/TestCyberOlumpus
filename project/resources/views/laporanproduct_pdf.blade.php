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
        <h5>Laporan Product</h4>
    </center>

    <table class='table table-bordered table-sm'>
        <thead>
            <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Nama Product</th>
                <th>Harga</th>
                <th>Promo</th>
                {{-- <th>Opsi</th> --}}
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($product as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->product_name }}</td>
                    <td>{{ number_format($p->price_agent,0,',','.') }}</td>
                    <td>{{ $p->price_promo }}</td>
            @endforeach
        </tbody>
    </table>

</body>

</html>
