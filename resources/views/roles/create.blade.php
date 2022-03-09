@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Role</h4>
          <form class="cmxform" id="AddRole" method="post">
            <fieldset>
              <div class="form-group">
                <label for="name">Role Name</label>
                <input id="role" autofocus class="form-control" name="name" type="text">
              </div>
              
              <input class="btn btn-outline-primary" type="submit" id="saveRole"value="Save Role">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop