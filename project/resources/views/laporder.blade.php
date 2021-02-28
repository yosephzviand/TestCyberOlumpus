@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <center>
                    <h3>Cetak Laporan Total</h3>
                </center>
                <form action="/laporan/order/proses" target="_blank" method="POST">
                    <div class="form-group row">
                        <input type="hidden" name="_token"
                            value="<?php echo csrf_token(); ?>">
                        <div class="col-md-4">
                            <input type="date" name="awal" id="awal" class="form-control">
                            s/d <input type="date" name="akhir" id="akhir" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">PDF</button>
                </form>
            </div>
        </div>
    </div>
@endsection
