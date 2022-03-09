@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Terminal Report Setup for {{$member->firstName}} {{$member->middleName}} {{$member->lastName}}</h4>
          <form class="cmxform" id="AddTerminalReportSetup" method="post">
            <fieldset>
              
              <div class="form-group"><input type="text" id="quid" value="{{$question->id}}" hidden/>
                <label for="level">Select Level</label>
                <select class="form-control" id="level" style="color:#000000">
                    @foreach ($levels as $level)
                        <option value="{{$level->id}}">{{$level->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="classname">Select Class</label>
                <select class="form-control" id="classname" style="color:#000000">
                    @foreach ($classes as $classs)
                        <option value="{{$classs->id}}">{{$classs->alternate_name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="term">Select Term</label>
                <select class="form-control" id="term" style="color:#000000">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
              </div>
              <input class="btn btn-outline-primary" type="submit" id="saveTRSetup"value="Continue">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop