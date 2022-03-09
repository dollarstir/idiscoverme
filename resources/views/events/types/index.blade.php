@extends('layouts.main')


@section('content')
    
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Event Types</h4>
      <a href="{{url("/event/types/new")}}" class="btn btn-outline-primary mb-4">Add New Event Type</a>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="eventtypeslist" class="table">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Created At</th>
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