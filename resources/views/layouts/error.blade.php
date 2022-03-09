<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Error Occurred</title>
  <link rel="stylesheet" href="{{url('/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{url('/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{url('/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url('/images/favicon.png')}}" />
</head>

<body>
  <div class="container-scroller">
      @yield('content')
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{url('/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
</body>

</html>
