@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Event Type</h4>
          <form class="cmxform" id="AddEventType" method="post">
              <fieldset>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-sm" autofocus name="eventtypename" id="eventtypename" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="color">Pick Event Type Color</label>
                    <input type='text' id="color" class="color-picker" value="#ffe74c" />
                  </div>
                  
                  <input class="btn btn-outline-primary mt-4" type="submit" id="saveEventType"value="Save">
                </fieldset>
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
@stop