@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Career Path</h4>
          <input type="text" value="{{$personality->id}}" id="cid" hidden/>
          <form class="cmxform" id="AddCareerPath" method="post">
              <fieldset>
                  <div class="form-group">
                    <label for="name">Career Path Name</label>
                    <input type="text" class="form-control form-control-sm" autofocus name="careerpaths" id="careerpaths" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alternativeName">Alternative Name</label>
                    <input id="alternativeName" class="form-control" required name="alternativeName" type="text">
                  </div>
                  
                  <input class="btn btn-outline-primary mt-4" type="submit" id="saveCareerPath"value="Save">
                </fieldset>
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
@stop