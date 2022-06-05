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
                        <h3 class="card-title" id="title">SEARCH DATA KARYAWAN</h3>
                    </div>
                    <div class="card-body">
                        {{-- <form action="{{ route('cek-proses') }}" method="post"> --}}
                            {{-- @csrf --}}
                        <form action="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">Input 1</label>
                                                <input type="text" name="input1" id="input1" placeholder="input 1 ..." class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">Input 2</label>
                                                <input type="text" name="input2" id="input2" placeholder="input 2 ..." class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label for="tgl_lahir">result</label>
                                                <h3 id="result">........</h3>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-success">
                                        <i class="glyphicon glyphicon-floppy-saved">Search</i>
                                    </button> --}}
                                    <button type="button" id='cek-submit' class="btn btn-success">
                                        <i class="glyphicon glyphicon-floppy-saved">Search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
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