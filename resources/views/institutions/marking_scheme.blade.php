@extends('layouts.main')


@section('content')
<div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Marking Scheme</h4>
          <form class="cmxform" id="saveMarkingScheme" method="post" enctype="multipart/form-data">
            <fieldset>
                <input type="hidden" value="{{$institution->institution_id}}" id="institution"/>
                <div class="form-group">
                    <label for="instypeid">Select Level</label>
                    <select class="form-control selectpicker" data-live-search="true"  name="level" title="" id="level" style="color:black">
                      <option selected></option>
                        @foreach ($levels as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </select>
                </div>    
              <div class="form-group">
                <label for="class_score">Class Score</label>
                <input id="class_score" class="form-control" name="class_score" type="text">
              </div>
              <div class="form-group">
                <label for="exams_score">Exams Score</label>
                <input id="exams_score" class="form-control" name="exams_score" type="text">
              </div>
              
              <input class="btn btn-primary" type="submit" id="btnSaveMarkingScheme" value="Save Scheme">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  @stop