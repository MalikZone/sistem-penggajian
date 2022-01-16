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
                    <h3 class="card-title">FORM KARYAWAN</h3>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (!isset($karyawan))
                                <form action="{{url('admin/karyawan/save-karyawan')}}" method="post">
                            @else
                                <form action="{{url('admin/karyawan/save-karyawan/' . $karyawan->id)}}" method="post">
                            @endif
                                @csrf
                                <div class="mb-4">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" placeholder="nama.." class="form-control" value="{{isset($karyawan) ? $karyawan->nama : ''}}">
                                </div>

                                <div class="mb-4">
                                    <label for="nama_karyawan">Divisi</label>
                                    <select class="form-control" name="divisi_id">
                                    <option>--pilih Divisi--</option>
                                    @foreach ($divisi as $item)
                                        <option value="{{$item->id}}" {{isset($karyawan->divisi_id) && $item->id == $karyawan->divisi_id ? 'selected' : ''}}>{{$item->divisi}}</option>   
                                    @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="nama_karyawan">Golongan</label>
                                    <select class="form-control" name="golongan_id">
                                    <option>--pilih Golongan--</option>
                                    @foreach ($golongan as $item)
                                        <option value="{{$item->id}}">{{$item->golongan}}</option>   
                                    @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" placeholder="tanggal lahir..." class="form-control" value="{{isset($karyawan) ? $karyawan->tgl_lahir : ''}}">
                                </div>

                                <div class="mb-4">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" placeholder="email..." class="form-control" value="{{isset($karyawan) ? $karyawan->email : ''}}">
                                </div>

                                <div class="mb-4">
                                    <label for="no_tlp">No Telepon</label>
                                    <input type="text" name="no_tlp" placeholder="telepon..." class="form-control" value="{{isset($karyawan) ? $karyawan->telepon : ''}}">
                                </div>

                                <div class="mb-4">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" placeholder="alamat..." class="form-control">{{isset($karyawan) ? $karyawan->alamat : ''}}</textarea>
                                </div>
                    
                                <div class="mb-4">
                                    <label for="nama">Jender</label>
                                    <select class="form-control" name="jender">
                                    <option>--pilih jender--</option>
                                    <option value="Laki-laki" {{isset($karyawan) && $karyawan->jender == "Laki-laki" ? 'selected' : ''}}>Laki-laki</option>
                                    <option value="Perempuan" {{isset($karyawan) && $karyawan->jender == "Perempuan" ? 'selected' : ''}}>Perempuan</option>
                                    </select>
                                </div>
                    
                                {{-- <div class="">
                                    <label for="jabatan">Jabatan</label>
                                    <select class="form-control" name="jabatan_id">
                                    <option>--pilih jabatan--</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{$item->id}}">{{$item->nama_jabatan}}</option>   
                                    @endforeach
                                    </select>
                                </div> --}}
                    
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