@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-7 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{$staff->firstName}} Role(s)</h4>
          <form class="" id="AssignRole" method="post">
              <input type="text" value="{{$staff->id}}" id="sid" hidden/>
                  <div class="form-group mb-4">
                      <label for="name" style="font-weight:bolder">Select Role(s)</label>
                      <div class="row">
                          @foreach ($roles as $role)
                            <div class="col-sm-3">
                                @if ($staff->hasRole($role->name))
                                  <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="role[]" value="{{$role->id}}" checked>
                                        {{$role->name}}
                                      </label>
                                    </div>
                                  @else
                                  <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="role[]" value="{{$role->id}}">
                                            {{$role->name}}
                                          </label>
                                  </div>
                                  @endif
                            </div>
                          @endforeach
                      </div>
                  </div>
              
              <input class="btn btn-outline-primary" type="submit" id="saveRole"value="Save Role">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop