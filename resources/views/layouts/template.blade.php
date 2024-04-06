<!DOCTYPE html>
<html>
  <head>
    <script>Nice</script>
    @include('components._head')
    @yield('head-complement')
    <title>@yield('title','Page title')</title>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      <?php/* include("_navbar.php") */?>
      @include('components._navbar')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('components._sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield('content','Page main content')
      </div>
      <!-- /.content-wrapper -->
      @include('components._footer')

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('components._js_files')
    @yield('js_files-complement')
  </body>
</html>


