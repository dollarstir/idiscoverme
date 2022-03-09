@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Personality</h4>
          <form class="cmxform" id="AddPersonality" method="post">
            <fieldset>
              <div class="form-group">
                <label for="name">Name</label>
                <input id="name" autofocus class="form-control" name="name" type="text">
              </div>
              <div class="form-group">
                <label for="relatedProgramme">Related Programme</label>
                <input id="relatedProgramme" class="form-control" name="relatedProgramme" type="text">
              </div>
              <div class="form-group">
                <label for="successMessage">Success Message</label>
                <textarea id="successMessage" class="form-control" name="successMessage"></textarea>
              </div>
              
              <input class="btn btn-outline-primary" type="submit" id="savePersonality"value="Save Personality">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop