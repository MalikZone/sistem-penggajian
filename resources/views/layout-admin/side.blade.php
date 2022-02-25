<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3">
        <div class="image d-flex justify-content-center">
          <img src="{{ asset('images/kota-tangerang.png') }}" class="img-circle elevation-2" alt="User Image" style="width:30%">
        </div>
        <div class="info d-flex justify-content-center">
          <h5 style="color: white;">Dispora Kota Tangerang</h5>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{route('dashboard')}}" class="nav-link @yield('dashboard') ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @if (Auth::user()->role == "admin-kepegawain")
            <li class="nav-item has-treeview menu-open">
              <a href="{{route('karyawan')}}" class="nav-link">
                <i class="nav-icon fas fa-id-card"></i>
                <p>
                  Data Pegawai
                </p>
              </a>
            </li>

            <li class="nav-item has-treeview menu-open">
              <a href="{{route('divisi')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Divisi
                </p>
              </a>
            </li>

            <li class="nav-item has-treeview menu-open">
              <a href="{{route('absensi')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Absesnsi
                </p>
              </a>
            </li>
          @endif

          @if (Auth::user()->role == "admin-keuangan")
            <li class="nav-item has-treeview menu-open">
              <a href="{{url('admin/golongan')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Golongan
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="{{route('potongan')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Potongan
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="{{route('gaji')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Data Gaji
                </p>
              </a>
            </li>
          @endif
          
          @if (Auth::user()->role == "admin-keuangan" || Auth::user()->role == "karyaw")
            <li class="nav-item has-treeview menu-open">
              <a href="{{route('detail-gaji')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Detail Gaji
                </p>
              </a>
            </li>
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>