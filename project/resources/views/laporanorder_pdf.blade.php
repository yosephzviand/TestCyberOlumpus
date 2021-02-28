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
        <h5>Laporan Order Customer</h4>
    </center>

    <table class='table table-bordered table-sm'>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Customer</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
            @foreach ($laporder as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ number_format($p->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
