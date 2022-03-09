@extends('layouts.main')


@section('content')
<div class="mr-md-3 mr-xl-5">
    <h2>Search Results for {{$search}}</h2>
  </div>


  <input type="text" value="{{$report->id}}" id="rid" hidden/>
  <input type="text" id="inid" value="{{$search}}" hidden/>

  @if($institution->count())
  <div class="card mb-4">
        <div class="card-body">
            <h4>{{$institution->first()->name}} - Report</h4>
            <div>Institution ID: {{$institution->first()->institution_id}}</div>
            
        <a href='{{url("/report/$report->id/statistics")}}' class="btn btn-outline-primary mb-2 mt-4 mr-2">View Statistics</a>
        <a href='{{url("/institution/$search/profile")}}' class="btn btn-outline-info mb-2 mt-4">View Detail</a>
        </div>
   </div>
   <div class="card mb-4">
        <div class="card-body">
        <h4 class="card-title">Members</h4>
        <div class="table-responsive">
                <table id="example" class="table">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Member ID</th>
                            <th>Profile</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
            </div>
        </div>
   </div>
  @else
  <div class="row mt-4">
        <div class="col-lg-6 alert alert-danger ml-3">Search not found!</div>
  </div>
  @endif
@stop