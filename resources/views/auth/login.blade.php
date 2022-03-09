
@extends('layouts.auth')


@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                @if (isset($setup))
                  <div style="width:80px;height:80px;margin:auto"><img src="data:image/png;base64,{{$setup->homepage_logo}}" alt="" style="max-width:100%"></div>
                @endif
              </div>
              <h2 class="text-center">{{$setup->software_name}}</h2>
              <h6 class="font-weight-light text-center">Sign in to continue.</h6>
              <form class="pt-3" method="post" action="{{ route('login') }}">
                 @if (session()->has('error'))
                    <div class="form-group">
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    </div>
                 @endif
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-light">Phone Number or Email Address</label>
                  <input type="text" class="form-control form-control-lg" name="phoneEmail" id="exampleInputEmail1" placeholder="" autofocus value="{{old('phoneEmail')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-light">Password</label>
                  <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="remember">
                        Keep me signed in
                      </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                  
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  @stop