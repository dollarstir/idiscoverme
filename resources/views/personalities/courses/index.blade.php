@extends('layouts.main')


@section('content')
    
<div class="card">
    <div class="card-body">
      <h4 class="card-title">{{$personality->name}} Courses</h4>
      <a href='{{url("/personalities/$personality->id/courses/new")}}' class="btn btn-outline-primary mb-4">Add New Course Related</a>
      <input type="text" value="{{$personality->id}}" id="psid" hidden/>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="coureses" class="table">
              <thead>
                <tr>
                    <th>Personality Name</th>
                    <th>Added At</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
               
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop