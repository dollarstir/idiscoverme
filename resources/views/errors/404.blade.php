@extends('layouts.error')

@section('content')
    
<div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center text-center error-page" style="background:#ffffff">
          <div class="row flex-grow">
            <div class="col-lg-7 mx-auto text-white">
              <div class="row align-items-center d-flex flex-row">
                <div class="col-lg-6 text-lg-right pr-lg-4">
                  <h1 class="display-1 mb-0" style="color:#000000;font-weight:bolder">Uhm!</h1>
                </div>
                <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4" style="color:#000000">
                  <h2>SORRY!</h2>
                  <h3 class="font-weight-light">The page you’re looking for was not found.</h3>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-12 text-center mt-xl-2">
                  <a class="text-white font-weight-medium" href="{{url('/')}}">Back to home</a>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-12 mt-xl-2" style="color:#000000">
                  <p class="text-white font-weight-medium text-center"><span style="color:#000000">Copyright &copy; {{date('Y',time())}}  All rights reserved. | Developed By </span><a href="http://deswebsolutions.com">Desweb Solutions Company Limited</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
@stop