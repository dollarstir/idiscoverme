<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{$setup->software_name}}</title>
  <link rel="stylesheet" href="{{url('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/fullcalendar/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/bootstrap-select/bootstrap-select.css')}}" />
  <link rel="stylesheet" href="{{url('/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/dropify/dropify.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/jquery-asColorPicker/css/asColorPicker.min.css')}}">
  <link rel="stylesheet" href="{{url('/css/vertical-layout-light/style.css')}}">
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
            @if (isset($setup))
            <a class="navbar-brand brand-logo" href="{{url('/')}}"><img src="data:image/png;base64,{{$setup->homepage_logo}}" alt="" style="max-width:30px;margin-right:10px;"><span style="color:{{$setup->color}}"><strong>{{$setup->software_short_name}}</strong></span></a>
            @endif 
          
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
              <span class="nav-profile-name">
                @if(isset(Auth::user()->id))
                  {{Auth::user()->firstName}}
                @endif
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{url('/profile')}}">
                <i class="mdi mdi-account text-primary"></i>
                Account
              </a>
              <a class="dropdown-item" href="{{url('/logout')}}">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
         
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
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
  <script src="{{url('/vendors/clipboard/clipboard.min.js')}}"></script>
  <script src="{{url('/vendors/bootstrap-select/bootstrap-select.min.js')}}"></script>
  <script src="{{url('/vendors/fullcalendar/fullcalendar.min.js')}}"></script>
  <script src="{{url('/vendors/jquery.repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{url('/vendors/dropify/dropify.min.js')}}"></script>
  <script src="{{url('/vendors/dropzone/dropzone.js')}}"></script>
  <script src="{{url('/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{url('/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{url('/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
  <script src="{{url('/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')}}"></script>
  <script src="{{url('/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{url('/vendors/jquery-asColor/jquery-asColor.min.js')}}"></script>
  <script src="{{url('/vendors/jquery-asGradient/jquery-asGradient.min.js')}}"></script>
  <script src="{{url('/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js')}}"></script>
  <script src="{{url('/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{url('/js/data-table.js')}}"></script>
  <script src="{{url('/js/body.js')}}"></script>
  <script src="{{url('/js/off-canvas.js')}}"></script>
  <script src="{{url('/js/hoverable-collapse.js')}}"></script>
  <script src="{{url('/js/template.js')}}"></script>
  <script src="{{url('/js/form-validation.js')}}"></script>
  <script src="{{url('/js/formpickers.js')}}"></script>
  <script src="{{url('/js/form-repeater.js')}}"></script>
  <script src="{{url('/js/bt-maxLength.js')}}"></script>
  <script src="{{url('/js/calendar.js')}}"></script>
  <script src="{{url('/js/dropify.js')}}"></script>
  <script src="{{url('/js/dropzone.js')}}"></script>
  <script src="{{url('/js/toastDemo.js')}}"></script>
  <script src="{{url('/js/desktop-notification.js')}}"></script>
  @if(isset($staffrecord))
    <script src="{{url('/js/assets/staffrecords.js')}}"></script>
  @endif
  @if(isset($rolerecords))
    <script src="{{url('/js/assets/rolerecords.js')}}"></script>
  @endif
  @if(isset($guardianrecords))
    <script src="{{url('/js/assets/guardianrecords.js')}}"></script>
  @endif
  @if(isset($guardianprofilerecord))
    <script src="{{url('/js/assets/guardianprofilerecord.js')}}"></script>
  @endif
  @if (isset($institutionrecords))
      <script src="{{url('/js/assets/institutionrecords.js')}}"></script>
  @endif
  @if (isset($institutionprofilerecords))
      <script src="{{url('/js/assets/institutionprofilerecords.js')}}"></script>
  @endif
  @if(isset($profilerecord))
    <script src="{{url('/js/assets/profilerecord.js')}}"></script>
  @endif
  @if(isset($member_records))
  <script src="{{url('/js/assets/member_records.js')}}"></script>
  @endif
  @if(isset($addmemberinstitutionrecords))
  <script src="{{url('/js/assets/addmemberinstitutionrecords.js')}}"></script>
  @endif
  @if(isset($personalityrecords))
  <script src="{{url('/js/assets/personalityrecords.js')}}"></script>
  @endif
  @if(isset($courserecords))
  <script src="{{url('/js/assets/courserecords.js')}}"></script>
  @endif
  @if(isset($careerpathrecords))
  <script src="{{url('/js/assets/careerpathrecords.js')}}"></script>
  @endif
  @if(isset($careerrecords))
  <script src="{{url('/js/assets/careerrecords.js')}}"></script>
  @endif
  @if(isset($questionrecords))
  <script src="{{url('/js/assets/questionrecords.js')}}"></script>
  @endif
  @if(isset($questionsetuprecords))
  <script src="{{url('/js/assets/questionsetuprecords.js')}}"></script>
  @endif
  @if(isset($clientrecord))
  <script src="{{url('/js/assets/clientrecord.js')}}"></script>
  @endif
    
  @if (isset($staffprofilerecords))
      <script src="{{url('/js/assets/staffprofilerecords.js')}}"></script>
  @endif
  @if (isset($eventtypesrecords))
      <script src="{{url('/js/assets/eventtypesrecords.js')}}"></script>
  @endif
  @if (isset($eventrecords))
      <script src="{{url('/js/assets/eventrecords.js')}}"></script>
  @endif
  @if (isset($terminalreport))
      <script src="{{url('/js/assets/terminalreport.js')}}"></script>
  @endif
  @if(isset($reportrecords))
  <script src="{{url('/js/report/report_records.js')}}"></script>
  @endif
  @if(isset($statistics))
    <script src="{{url('/js/chart.js')}}"></script>
  @endif
</body>
</html>

