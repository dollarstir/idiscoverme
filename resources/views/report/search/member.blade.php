@extends('layouts.main')


@section('content')
<div class="mr-md-3 mr-xl-5">
    <h2>Search Results for {{$search}}</h2>
  </div>
<input type="text" value="{{$report->id}}" id="rid" hidden/>
<input type="text" id="sid" value="{{$search}}" hidden/>
@if($member->count())
<div class="card mb-4">
  <div class="card-body">
      <h4>{{$member->first()->firstName}} {{$member->first()->middleName}} {{$member->first()->lastName}} - Report</h4>
      <div>Member ID: {{$member->first()->member_id}}</div>
      
  <a href='{{url("/report/$report->id/statistics")}}' class="btn btn-outline-primary mb-2 mt-4 mr-2">View Statistics</a>
  <a href='{{url("/member/$search/profile")}}' class="btn btn-outline-info mb-2 mt-4">View Profile</a>
  </div>
</div>
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">Institution Report</h4>
    <div class="row">
          <div class="col-12">
                  <div class="table-responsive">
                    <table id="institutions" class="table">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Logo</th>
                              <th>Institution <br/><br/>Type</th>
                              <th>Information</th>
                              <th>Generate<br/><br/> Token</th>
                              <th>Remove</th>
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

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Questions Answered Report</h4>
    <div class="row">
          <div class="col-12">
                  <div class="table-responsive">
                    <table id="questionreport" class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Created At</th>
                          <th>Question <br/><br />Report</th>
                          <th>Terminal<br /><br />Report</th>
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

@else
<div class="row mt-4">
  <div class="col-lg-6 alert alert-danger ml-3">Search not found!</div>
</div>
@endif
@stop