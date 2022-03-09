@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit {{$personality->name}} Personality</h4>
          <form class="cmxform" id="EditPersonality" method="post"><input type="text" id="pid" value="{{$personality->id}}" hidden/>
            <fieldset>
              <div class="form-group">
                <label for="name">Name</label>
              <input id="name" autofocus class="form-control" name="name" type="text" value="{{$personality->name}}">
              </div>
              <div class="form-group">
                <label for="relatedProgramme">Related Programme</label>
                <input id="relatedProgramme" class="form-control" name="relatedProgramme" type="text" value="{{$personality->related_programme}}">
              </div>
              <div class="form-group">
                <label for="successMessage">Success Message</label>
                <textarea id="successMessage" class="form-control" name="successMessage">{{$personality->success_message}}</textarea>
              </div>
              
              <input class="btn btn-outline-primary" type="submit" id="savePersonality"value="Update Personality">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop