<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SISTEM PENGGAJIAN KARYAWAN @yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('template-backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="{{ asset('template-backend/http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template-backend/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- bootstrap --}}
  @yield('ckeditor')
  @yield('bootstrap')



</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link d-flex justify-content-start">
          <form action="{{ route('logout') }}" method="POST" class="">
              @csrf
              <button type="submit" class="btn btn-danger mt-1"><i class="fas fa-sign-out-alt"></i></button>
          </form>
          <p class="m-2">Logout</p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layout-admin.side')

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: url('{{ asset('images/lobbydispora.jpg')}}'); background-size: cover;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          @yield('content')
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    {{-- <strong>Di bentuk dan dibesarkan seperti anak sendiri</a>.</strong> --}}
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('template-backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('template-backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('template-backend/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('template-backend/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('template-backend/dist/js/demo.js') }}"></script>
<script src="{{ asset('template-backend/dist/js/pages/dashboard3.js') }}"></script>
<script>
         let routes = {
                  cek_proses : "{{ route('cek-proses') }}"
          };
</script>
<script src="{{asset('js/main.js')}}"></script>
@yield('data-table')
</body>
</html>
