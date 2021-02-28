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
        <h5>Laporan Penjualan Kategori</h4>
    </center>

    <table class='table table-bordered table-sm'>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th>Total Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
            @foreach ($jualkategori as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ $p->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
