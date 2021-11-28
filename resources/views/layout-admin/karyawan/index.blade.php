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
                        <h3 class="card-title">DATA KARYAWAN</h3>
                    </div>
                    <!-- /.card-header -->
                    
                    <div class="card-body">
                        <a href="{{route('form-karyawan')}}" class="btn btn-success" style="margin-bottom: 20px">
                            <i class="fa fa-plus">Tambah Data</i>
                        </a>
                        <div class="table-responsive">
                            <table id="tabel-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Divisi</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Jender</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @forelse ($karyawan as $key => $item)
                                        <tr>
                                            {{-- <td>{{$key + 1}}</td> --}}
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->nama}}</td>
                                            <td>{{$item->tgl_lahir}}</td>
                                            <td>{{$item->divisi}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->telepon}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>{{$item->jender}}</td>
                                            <td class="text-center">
                                                <a href="{{url('admin/karyawan/form-karyawan/' . $item->id)}}" class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                {{-- <a href="{{url('admin/karyawan/delete-karyawan/' . $item->id)}}" onclick="return confirm('Hapus Data ?')" class="btn btn-danger">
                                                    <i class="fa fa-edit"></i>
                                                </a> --}}
                                                {{-- <form action="{{url('admin/karyawan/delete-karyawan/' . $item->id)}}" method="post" onclick="return confirm('Hapus Data ?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form> --}}
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
                        
                    </div>
                </div>   
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