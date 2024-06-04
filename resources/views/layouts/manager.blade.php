<!DOCTYPE html>
<html>
  <head>
    @include('components._head')
    @yield('head-complement')
    <title>@yield('title','Page title')</title>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: inherit"><i class="fas fa-bars"></i></a>
        
        {{-- navbar User icon --}}
        <li class="navbar-nav ml-auto nav-item dropdown mr-2">
          <a class="user-panel d-flex" data-toggle="dropdown" href="#">
            <div class="image">
              <i class="fas fa-user img-circle bg-white"></i>
              {{-- <img src="../../../public/img/icons8-user-24.png"></img> --}}
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu dropdown-menu-right">
            <span class="dropdown-item dropdown-header">
              <div class="d-block" href="#" style="color: #044687;"><?php echo "John Doe";// echo $_SESSION['firstname'] ." ". $_SESSION['name'] ?></div>
            </span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item"> <i class="fas fa-user mr-2"></i> Profil</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item"> <i class="fas fa-sliders-h mr-2"></i> Paramètres</a>
            <div class="dropdown-divider"></div>
            <a href="../Controllers/deconnexion.php" class="dropdown-item"> <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion</a>
          </div>
        </li>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/managerDashboard" class="brand-link">
          <img src="img/logo4.png" alt="Logo" class="brand-image img-circle elevation-3 mr-3 bg-white" style="opacity: .8">
          <span class="brand-text font-weight-light">SOLUX</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              
              <li class="nav-item">
                <a href="/managerDashboard" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>Tableau de bord</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/contracts" class="nav-link">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>Contracts</p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield('content','Page main content')
      </div>
      <!-- /.content-wrapper -->

    @include('components._js_files')
    @yield('js_files-complement')
  </body>
</html>


