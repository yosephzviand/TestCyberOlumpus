@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <center>
                    <h3>Data Order</h3>
                </center>
                {{-- <a href="/home" class="btn btn-info">Kembali </a> --}}

                <br />
                <br />
                {{-- <form action="/pegawai/cari" method="GET" class="form-inline">
                    <input class="form-control" type="text" name="cari" placeholder="Cari Pegawai .."
                        value="{{ old('cari') }}">
                    <input type="submit" class="btn btn-primary ml-3" value="CARI">
                </form> --}}

                <table class='table table-bordered table-sm'>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Agent</th>
                        <th>Qty</th>
                        {{-- <th>Kelurahan</th> --}}
                        {{-- <th>Opsi</th> --}}
                    </tr>
                    @php $i=1 @endphp
                    @foreach ($orders as $p)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->store_name }}</td>
                            <td>{{ $p->qty }}</td>
                            {{-- <td>{{ $p->kelurahan }}</td> --}}
                            {{-- <td>
                                <a href="/pegawai/edit/{{ $p->id }}" class="btn btn-primary btn-sm">Edit</a>

                                <a href="/pegawai/hapus/{{ $p->id }}" class="btn btn-danger btn-sm">Hapus</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </table>

                {{ $orders->links() }}

            </div>
        </div>
    </div>
@endsection
