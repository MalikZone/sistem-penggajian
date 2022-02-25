@extends('layout-admin.master-admin')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('example-page', 'active')
@section('title', '| Data Karyawan')

@section('judul')
    <h1>Tabel Data </h1>
@endsection

@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">GENERATE GAJI KARYAWAN</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/detail-gaji/generate-detail-gaji') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">Tanggal Periode Awal</label>
                                                <input type="date" name="periode_form" placeholder="periode..." class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">Tanggal Periode Akhir</label>
                                                <input type="date" name="periode_to" placeholder="periode..." class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="glyphicon glyphicon-floppy-saved">Generate Gaji</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>   
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">FILTER GAJI KARYAWAN</h3>
                    </div>
                    @if ($message = Session::get('error'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ url('admin/detail-gaji') }}" method="get">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">Tanggal Periode Awal</label>
                                                <input type="date" name="periode_from" placeholder="periode..." class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">Tanggal Periode Akhir</label>
                                                <input type="date" name="periode_to" placeholder="periode..." class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">Nama</label>
                                                <input type="text" name="name" placeholder="nama..." class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="glyphicon glyphicon-floppy-saved">Filter</i>
                                    </button>
                                    @php
                                        $params = '';
                                        if (isset($filters['periode_from']) && isset($filters['periode_to'])) {
                                            $params = 'periode_from='.$filters['periode_from'].'&'.'periode_to='.$filters['periode_to'];
                                        }
                                    @endphp
                                    <a href="{{ url('admin/detail-gaji/export-excel?'.$params)}}" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-floppy-saved">export excel</i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>   
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">DETAIL GAJI KARYAWAN</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Karyawan</th>
                                <th>Periode</th>
                                <th>Gaji Pokok</th>
                                <th>Potongan</th>
                                <th>Total Gaji</th>
                                <th>Aksi</th>
                            </tr>
                            @forelse ($detailGaji as $key => $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->karyawan->nama}}</td>
                                    <td>{{$item->periode_from.' - '.$item->periode_to}}</td>
                                    <td>{{number_format($item->karyawan->gaji->gaji, 0)}}</td>
                                    <td>{{number_format($item->potongan, 0)}}</td>
                                    <td>{{number_format($item->total_gaji,0)}}</td>
                                    <td class="text-center">
                                        <a href="{{url('admin/detail-gaji/detail/' . $item->id)}}" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fa fa-edit">detail</i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data Kosong</td>
                                </tr>
                            @endforelse
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
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