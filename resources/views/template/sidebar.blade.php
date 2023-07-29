
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('home') }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ url('dashboard') }}" class="nav-link {{(request()->segment(2) == 'dashboard') ? 'active': ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          if
          @if (auth()->user()->name == 'admin') 
          <li class="nav-header">TBC</li>
          <li class="nav-item {{(request()->segment(1) == 'gejalapenyakit') ? 'active': ''}}">
            <a class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data TBC
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item {{(request()->segment(1) == 'gejalapenyakit') ? 'active': ''}}">
                <a href="{{ url('gejalapenyakit') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gejalan Penyakit TBC</p>
                </a>
              </li>
              <li class="nav-item {{(request()->segment(2) == 'gejalatbc') ? 'active': ''}}">
                <a href="{{ url('gejalapenyakit/gejala') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gejalan TBC</p>
                </a>
              </li>
              <li class="nav-item {{(request()->segment(2) == 'penyakit') ? 'active': ''}}">
                <a href="{{ url('gejalapenyakit/penyakit') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penyakit TBC</p>
                </a>
              </li>
              <li class="nav-item {{(request()->segment(1) == 'datacasediagnosabaru') ? 'active': ''}}">
                <a href="{{ url('datacasediagnosabaru') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Case Diagnosa Baru</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Admin</li>
          <li class="nav-item">
            <a class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Property Admin
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item {{(request()->segment(1) == 'datacasediagnosabaru') ? 'user': ''}}">
                <a href="{{ url('user') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data User</p>
                </a>
              </li>
              <li class="nav-item {{(request()->segment(1) == 'datacasediagnosabaru') ? 'mencaridiagnosa': ''}}">
                <a href="{{ url('mencaridiagnosa') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Access</p>
                </a>
              </li>
              <li class="nav-item {{(request()->segment(1) == 'datacasediagnosabaru') ? 'datacasediagnosabaru': ''}}">
                <a href="{{ url('datacasediagnosabaru') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting Web</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- <li class="nav-header">Lain - Lain</li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    