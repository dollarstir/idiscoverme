@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Event</h4>
          <form class="cmxform" id="AddEvent" method="post">
              <fieldset><input type="text" value="" id="rid" hidden/>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-sm" autofocus name="eventname" id="eventname" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="eventdesc">Description</label>
                      <textarea type="text" class="form-control form-control-sm" name="eventdesc" id="eventdesc"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="privacy">Event Privacy</label>
                      <select class="form-control" id="privacy" style="color:#000000">
                          <option value="0">Private</option>
                          <option value="1">Public</option>
                          <option value="2">Custom</option>
                      </select>
                  </div>
                  <div class="form-group mt-4">
                      <div class="input-group input-daterange d-flex align-items-left">
                          <div class="input-group mr-4 mb-2"><label for="start_at">Start Date</label></div>
                          <input type="text" class="form-control text-left" id="start_at" name="start_at">
                          <div class="input-group mt-4 mb-2"><label for="end_at">End Date</label></div>
                          <input type="text" class="form-control text-left" id="end_at" name="end_at">
                      </div>
                  </div>
                  <div class="form-group mt-4">
                    <label for="privacy">Start Time</label>
                    <div class="input-group date" id="start_time" data-target-input="nearest">
                      <div class="input-group" data-target="#start_time" data-toggle="datetimepicker">
                        <input type="text" class="form-control datetimepicker-input" id="set_start_time" name="start_time" data-target="#start_time"/>
                        <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                      </div>
                    </div>
                  </div>
                  <label for="privacy">End Time</label>
                  <div class="form-group mt-4">
                    <div class="input-group date" id="end_time" data-target-input="nearest">
                      <div class="input-group" data-target="#end_time" data-toggle="datetimepicker">
                        <input type="text" class="form-control datetimepicker-input" id="set_end_time" name="end_time" data-target="#end_time"/>
                        <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                      </div>
                    </div>
                  </div>
                  <input class="btn btn-outline-primary mt-4" type="submit" id="saveEvent"value="Save">
                </fieldset>
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
@stop