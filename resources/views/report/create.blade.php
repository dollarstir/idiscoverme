@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Generate Report</h4>
          <form class="cmxform" id="AddReport" method="post">
            <fieldset>
              <div class="form-group">
                <label for="name">Name</label>
                <input id="name" autofocus class="form-control" name="name" type="text">
              </div>
            <div class="form-group">
                <label for="privacy">Report Type</label>
                <select class="form-control" id="type" style="color:#000000">
                    <option value="0">Summary</option>
                    <option value="1">Member</option>
                    <option value="2">Members</option>
                    <option value="3">Institution</option>
                    <option value="4">Institutions</option>
                    <option value="5">Guardian</option>
                    <option value="6">Guardians</option>
                    <option value="7">Client</option>
                    <option value="8">Clients</option>
                    <option value="9">Question Setup</option>
                    <option value="10">Question Setups</option>
                </select>
                </select>
            </div>
            <div class="form-group" style="display:none;" id="searchcover">
              <label for="searchText" id="searchType">Name</label>
              <input id="searchText" class="form-control" name="searchText" type="text">
            </div>
              <div class="form-group mt-4">
                <label for="date_range" class="mb-4 text-muted">Select Date Range</label>
                <div class="input-group input-daterange d-flex align-items-left" id="date_range">
                    <div class="input-group mr-4 mb-2"><label for="start_at">Start Date</label></div>
                    <input type="text" class="form-control text-left" id="start_at" name="start_at">
                    <div class="input-group mt-4 mb-2"><label for="end_at">End Date</label></div>
                    <input type="text" class="form-control text-left" id="end_at" name="end_at">
                </div>
            </div>
             
              
              <input class="btn btn-outline-primary" type="submit" id="saveReport"value="Continue">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop