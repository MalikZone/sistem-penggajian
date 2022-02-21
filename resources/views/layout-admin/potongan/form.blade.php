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
                    <h3 class="card-title">FORM GAJI</h3>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (!isset($potongan))
                                <form action="{{url('admin/potongan/save-potongan')}}" method="post">
                            @else
                                <form action="{{url('admin/potongan/save-potongan/' . $potongan->id)}}" method="post">
                            @endif
                                @csrf
                                <div class="mb-4">
                                    <label for="tgl_lahir">Keterangan</label>
                                    <input type="text" name="keterangan" placeholder="Keterangan..." class="form-control" value="{{isset($potongan) ? $potongan->keterangan : ''}}">
                                </div>

                                <div class="mb-4">
                                    <label for="tgl_lahir">Jumlah</label>
                                    <input type="number" name="jumlah" placeholder="Gaji Pokok..." class="form-control" value="{{isset($potongan) ? $potongan->potongan : ''}}">
                                </div>
                    
                                <button type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-floppy-saved">Simpan</i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection

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