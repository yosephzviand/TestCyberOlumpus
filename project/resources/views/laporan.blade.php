@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <center>
                    <h3>Laporan</h3>
                </center>
                <a class="navbar-brand" href="#">
                    Cetak Laporan Users
                </a>
                <br>
                <a class="navbar-brand" href="#">
                    Cetak Laporan Product
                </a>
                <br>
                <a class="navbar-brand" href="# ">
                    Cetak Laporan Orders
                </a>
                <br>
                <a class="navbar-brand" href="# ">
                    Cetak Laporan Total
                </a>
                <br>
                <a class="navbar-brand" href="# ">
                    Cetak Laporan Order Customer
                </a>
                <br>
                <a class="navbar-brand" href="# ">
                    Cetak Laporan Order Agent
                </a>
                <br>
                <a class="navbar-brand" href="# ">
                    Cetak Laporan Keuntungan
                </a>
                <br>
                <a class="navbar-brand" target="_blank" href="{{ url('/laporan/jualkategori') }}">
                    Cetak Laporan Penjualan
                </a>
                <br>
                <a class="navbar-brand" target="_blank" href="{{ url('/laporan/topproduct') }}">
                    Cetak Laporan Top Product
                </a>
                <br>
                <a class="navbar-brand" target="_blank" href="{{ url('/laporan/topcustomer') }}">
                    Cetak Laporan Top Customer
                </a>
                <br>
                <a class="navbar-brand" target="_blank" href="{{ url('/laporan/topagent') }}">
                    Cetak Laporan Top Agent
                </a>
            </div>
        </div>
    </div>
@endsection
