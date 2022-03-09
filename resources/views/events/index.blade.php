@extends('layouts.main')


@section('content')
    
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Events</h4>
      <a href="{{url("/event/new")}}" class="btn btn-outline-primary mb-4">Add New Event</a>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="eventtypeslist" class="table">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Start At</th>
                    <th>End At</th>
                    <th>Privacy</th>
                    <th></th>
                    <th></th>
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