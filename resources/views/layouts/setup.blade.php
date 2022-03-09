<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>System Setup | Desweb Solutions</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{url('/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <!-- End plugin css for this page -->
  <link rel="stylesheet" href="{{url('/vendors/fullcalendar/fullcalendar.min.css')}}">
  <!-- inject:css -->
  <link rel="stylesheet" href="{{url('/vendors/dropify/dropify.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/jquery-asColorPicker/css/asColorPicker.min.css')}}">
  <link rel="stylesheet" href="{{url('/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url('/images/favicon.png')}}" />
  <style>
    table td {
  word-wrap: break-word;
  max-width: 300px;
  
}
body{visibility: hidden}
#example td {
  white-space:inherit;
  line-height: 150%;
}
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{url('/images/logo.svg')}}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-white" href="index.html"><img src="{{url('/images/logo-white.svg')}}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{url('/images/logo-mini.svg')}}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
         
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{url('/images/avatar.png')}}" alt="profile"/>
              <span class="nav-profile-name">Administrator</span>
            </a>
            
          </li>
         
        </ul>
        
      </div>
    </nav>
    <!-- partial --><input type="text" value="/" id="url" hidden/>
    <div class="container-fluid page-body-wrapper">
        @include('includes.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
           
              @yield('content')
              
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{url('/vendors/js/vendor.bundle.base.js')}}"></script>
  
  <script src="{{url('/vendors/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{url('/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{url('/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
  <script src="{{url('/vendors/moment/moment.min.js')}}"></script>
  <script src="{{url('/vendors/fullcalendar/fullcalendar.min.js')}}"></script>
  <script src="{{url('/vendors/jquery.repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{url('/vendors/dropify/dropify.min.js')}}"></script>
  <script src="{{url('/vendors/dropzone/dropzone.js')}}"></script>
  <script src="{{url('/vendors/jquery-asColor/jquery-asColor.min.js')}}"></script>
  <script src="{{url('/vendors/jquery-asGradient/jquery-asGradient.min.js')}}"></script>
  <script src="{{url('/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js')}}"></script>
  <script src="{{url('/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{url('/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{url('/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
  <script src="{{url('/js/data-table.js')}}"></script>
  <script src="{{url('/js/body.js')}}"></script>
  <script src="{{url('/js/off-canvas.js')}}"></script>
  <script src="{{url('/js/hoverable-collapse.js')}}"></script>
  <script src="{{url('/js/formpickers.js')}}"></script>
  <script src="{{url('/js/template.js')}}"></script>
  <script src="{{url('/js/form-validation.js')}}"></script>
  <script src="{{url('/js/form-repeater.js')}}"></script>
  <script src="{{url('/js/bt-maxLength.js')}}"></script>
  <script src="{{url('/js/calendar.js')}}"></script>
  <script src="{{url('/js/dropify.js')}}"></script>
  <script src="{{url('/js/dropzone.js')}}"></script>
  <script src="{{url('/js/toastDemo.js')}}"></script>
  
  <script src="{{url('/js/assets/setup.js')}} "></script>
</body>
</html>

