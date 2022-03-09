@extends('layouts.main')


@section('content')
    
<div class="card">
    <div class="card-body">
      <h4 class="card-title">{{$questionsetup->name}} Questions</h4>
      <a href='{{url("/questions/setup/$questionsetup->id/questions/new")}}'  class="btn btn-outline-primary mb-4">Add New Questions</a>
      <div class="row">
          <input type="text" id="qstp" value="{{$questionsetup->id}}" hidden/>
        <div class="col-12">
          <div class="table-responsive">
            <table id="questions" class="table">
              <thead>
                <tr>
                    <th>No.</th>
                    <th>Question</th>
                    <th>Career Path</th>
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