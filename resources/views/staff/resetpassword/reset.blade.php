@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Reset Password</h4>
          <form class="cmxform" id="resetPassword" method="post">
            <fieldset>
              <div class="form-group">
                <label for="oldpass">Old Password</label>
                <input id="oldpass" autofocus class="form-control" name="oldpassword" type="password">
              </div>
              <div class="form-group">
                  <label for="newpass">New Password</label>
                  <input id="newpass" class="form-control" name="newpassword" type="password">
              </div>
              <div class="form-group">
                    <label for="confirmpass">Confirm Password</label>
                    <input id="confirmpass" class="form-control" name="confirmpassword" type="password">
              </div>
              
              <input class="btn btn-outline-primary" type="submit" id="resetPword"value="Reset">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop