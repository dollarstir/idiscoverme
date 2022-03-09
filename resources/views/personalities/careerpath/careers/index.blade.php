@extends('layouts.main')


@section('content')
    
<div class="card">
    <div class="card-body">
      <h4 class="card-title">{{$careerpath->name}} Related Careers</h4>
      <a href='{{url("/personalities/$personality->id/career/path/$careerpath->id/new")}}' class="btn btn-outline-primary mb-4">Add New Career</a>
      <input type="text" value="{{$personality->id}}" id="psid"hidden/>
      <input type="text" value="{{$careerpath->id}}" id="cpid" hidden/>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="careerpath" class="table">
              <thead>
                <tr>
                    <th>Career Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
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