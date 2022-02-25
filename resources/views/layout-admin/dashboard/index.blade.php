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
                <div class="jumbotron jumbotron-fluid" style="background-image: url('{{ asset('images/kampung_tangerang.jpg')}}'); background-size: cover;">
                    <div class="row">
                        <div class="container d-flex justify-content-center">
                            <img src="{{ asset('images/kota-tangerang.png') }}" width="100" alt="User Image" style="width: 20%">
                        </div>
                        <div class="container d-flex justify-content-center mt-2">
                            <br>
                            <br>
                            <h1 class="" style="color: white"><b>Selamat datang di SI-PENGGAJIAN  <br> DISPORA KOTA TANGERANG</b></h1>
                            {{-- <h2 class="" style="color: black"><b></b></h2> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$pegawai->count()}}</h3>
                        <p>Data Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{route('karyawan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <div class="col-lg-6 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$divisi->count()}}</h3>
                        <p>Jumlah Divisi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <a href="{{route('divisi')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
    