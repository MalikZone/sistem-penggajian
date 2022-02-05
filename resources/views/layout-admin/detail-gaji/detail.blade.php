@extends('layout-admin.master-admin')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('example-page', 'active')
@section('title', '| Detail Gaji')

@section('judul')
    <h1>Tabel Data </h1>
@endsection

@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="invoice p-3 mb-3" style="width: 100%;">
        <!-- title row -->
        <div class="row">
        <div class="col-12">
            <h4>
            <i class="fas fa-globe"></i> AdminLTE, Inc.
            <small class="float-right">Periode: {{$detailGaji->periode_from.' - '.$detailGaji->periode_to}}</small>
            </h4>
        </div>
        <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
            <strong>Nama Perusahaan</strong><br>
            Alamat: Alamat Perusahaan<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
            <strong>{{$detailGaji->karyawan->nama}}</strong><br>
            Alamat: {{$detailGaji->karyawan->alamat}}<br>
            Phone: {{$detailGaji->karyawan->telepon}}<br>
            Email: {{$detailGaji->karyawan->email}}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice #{{$detailGaji->id}}</b><br>
            <br>
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Karyawan</th>
                        <th>Periode</th>
                        <th>Gaji Pokok</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$detailGaji->id}}</td>
                        <td>{{$detailGaji->karyawan->nama}}</td>
                        <td>{{$detailGaji->periode_from.' - '.$detailGaji->periode_to}}</td>
                        <td>{{number_format($detailGaji->karyawan->gaji->gaji, 0)}}</td>
                        <td>{{number_format($detailGaji->potongan, 0)}}</td>
                        <td>{{number_format($detailGaji->total_gaji,0)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                {{-- <p class="lead">Detail Potongan Absensi</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>potongan</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        {{dd($absen)}}
                        @foreach ($absen as $item)
                            <tr>
                                <td>{{$item->keterangan}}</td>
                                <td>test</td>
                                <td>{{number_format($detailGaji->karyawan->gaji->gaji * (1/100), 0)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
                <p class="lead">Detail Potongan Lain-Lain</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Periode</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($potongan as $item)
                            <tr>
                                <td>{{$item->keterangan}}</td>
                                <td>{{$detailGaji->periode_from.' - '.$detailGaji->periode_to}}</td>
                                <td>{{$item->potongan}}</td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <th>Total</th>
                            <th></th>
                            <th>{{number_format($detailGaji->potongan, 0)}}</th>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <p class="lead">Periode: {{$detailGaji->periode_from.' - '.$detailGaji->periode_to}}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                        <th style="width:50%">Gaji Pokok:</th>
                            <td>{{number_format($detailGaji->karyawan->gaji->gaji, 0)}}</td>
                        </tr>
                        <tr>
                            <th>Total Potongan:</th>
                            <td>{{number_format($detailGaji->potongan, 0)}}</td>
                        </tr>
                        <tr>
                            <th>Gaji Diterima:</th>
                            <td>{{number_format($detailGaji->total_gaji,0)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        {{-- <div class="row">
            <div class="col-6">
                <p class="lead">Detail Potongan Lain-Lain</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Periode</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($potongan as $item)
                            <tr>
                                <td>{{$item->keterangan}}</td>
                                <td>{{$detailGaji->periode_from.' - '.$detailGaji->periode_to}}</td>
                                <td>{{$item->potongan}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
        <div class="col-12">
            {{-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
            {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
            Payment
            </button> --}}
            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
            <i class="fas fa-download"></i> Generate PDF
            </button>
        </div>
        </div>
    </div>
    <!-- /.invoice -->
    @section('js-bootstrap')
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @endsection
    @section('data-table')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#tabel-data').DataTable();
            });
        </script>
    @endsection 
        <script>
            CKEDITOR.replace( 'summary_ekskul' );
        </script>
@endsection
