@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add Course Related</h4>
          <input type="text" value="{{$personality->id}}" id="cid" hidden/>
          <form class="cmxform" id="AddCourse" method="post">
            @if($personalities->count())
            <fieldset>
              @foreach ($personalities as $personaliti)
                 <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" id="course" class="form-check-input" name="course[]" value="{{$personaliti->id}}"
                        {{(in_array($personaliti->id,$course_related_personalities)) ? 'checked' : ''}}
                      >
                      {{$personaliti->name}}
                    </label>
                  </div>
              @endforeach
              
              
              <input class="btn btn-outline-primary mt-4" type="submit" id="saveCourse"value="Save">
            </fieldset>
            @else
              <div class="alert alert-info">No personalities found!.</div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
@stop