@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Question Setup</h4>
          <form class="cmxform" id="AddSetup" method="post">
            <fieldset>
              <div class="form-group">
                <label for="name">Setup Name</label>
                <input id="setup" autofocus class="form-control" name="name" type="text">
              </div>
              
              <input class="btn btn-outline-primary" type="submit" id="saveSetup"value="Save Setup">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop