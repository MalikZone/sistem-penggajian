<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="invoice p-3 mb-3" style="width: 100%;">
            <!-- title row -->
            <div class="row">
            <div class="col-12">
                <h4>
                <i class="fas fa-globe"></i> AdminLTE, Inc.
                <small class="float-right">Periode: {{$detailGaji['periode_from'].' - '.$detailGaji['periode_to']}}</small>
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
                    <strong>{{$detailGaji['karyawan']['nama']}}</strong><br>
                    Alamat: {{$detailGaji['karyawan']['alamat']}}<br>
                    Phone: {{$detailGaji['karyawan']['telepon']}}<br>
                    Email: {{$detailGaji['karyawan']['email']}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #{{$detailGaji['id']}}</b><br>
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
                            <td>{{$detailGaji['id']}}</td>
                            <td>{{$detailGaji['karyawan']['nama']}}</td>
                            <td>{{$detailGaji['periode_from'].' - '.$detailGaji['periode_to']}}</td>
                            <td>{{number_format($detailGaji['karyawan']['gaji']['gaji'], 0)}}</td>
                            <td>{{number_format($detailGaji['potongan'], 0)}}</td>
                            <td>{{number_format($detailGaji['total_gaji'],0)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
            </div>

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    {{-- <p class="lead">Detail Potongan Absensi</p>
                    <table class="table table-striped">
                        <thead>clear
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
                                    <td>{{$item['keterangan']}}</td>
                                    <td>{{$detailGaji['periode_from'].' - '.$detailGaji['periode_to']}}</td>
                                    <td>{{$item['potongan']}}</td>
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
                    <p class="lead">Periode: {{$detailGaji['periode_from'].' - '.$detailGaji['periode_to']}}</p>
    
                    {{-- <div class="table-responsive">
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
                    </div> --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
</body>
</html>
    
