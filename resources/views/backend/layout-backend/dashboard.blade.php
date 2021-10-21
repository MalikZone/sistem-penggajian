@extends('backend.layout-backend.main')
@section('dashboard', 'active')
@section('title', '| Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="title-page text-center">
                <h1>Data Utama</h1>
            </div>
        </div>
    </div>
    <br><br>
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card bg-success">
                            <div class="card-body d-flex justify-content-between">
                                <div class="data-info">
                                    <div class="inner">
                                        <h3>{{ $berita }}</h3>
                                        <p>Berita</p>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-newspaper fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <div class="info d-flex justify-content-center">
            <div class="col-lg-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                    <h3>10</h3>
                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users fa-3x"></i>
                </div>
                {{-- <a href="{{ route('kegiatan.index') }}" class="small-box-footer">olah kegiatan <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>10</h3>
                    <p>Data 1</p>
                </div>
                <div class="icon">
                    <i class="fas fa-id-card fa-3x"></i>
                </div>
                {{-- <a href="{{ route('kegiatan.index') }}" class="small-box-footer">olah kegiatan <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                    <h3>10</h3>
                    <p>Data 2</p>
                </div>
                <div class="icon">
                    <i class="far fa-file-alt fa-3x"></i>
                </div>
                {{-- <a href="{{ route('kegiatan.index') }}" class="small-box-footer">olah kegiatan <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="small-box bg-success">
                    <div class="inner">
                    <h3>10</h3>
                    <p>Data 3</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper fa-3x"></i>
                </div>
                {{-- <a href="{{ route('kegiatan.index') }}" class="small-box-footer">olah kegiatan <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection