@extends('layouts.main')


@section('content')
    
<div class="card">
    <div class="card-body">
      <h4 class="card-title">{{$personality->name}} Career Path</h4>
      <a href='{{url("/personalities/$personality->id/career/path/new")}}' class="btn btn-outline-primary mb-4">Add New Career Path</a>
      <input type="text" value="{{$personality->id}}" id="psid"hidden/>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="careerpath" class="table">
              <thead>
                <tr>
                    <th>Career Path Name</th>
                    <th>Alternative Name</th>
                    <th>Careers</th>
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