@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-7 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{$role->name}} Permissions</h4>
          <form class="" id="AddPermission" method="post">
            <fieldset><input type="text" id="pid" value="{{$role->id}}"hidden />
              
                  @foreach ($permission_type as $permission_type)
                  <div class="form-group mb-4">
                  <label for="name" style="font-weight:bolder">{{$permission_type->name}}</label>
                   <div class="row">
                    @foreach ($permission_type->permissions($permission_type->id) as $permission)
                     <div class="col-sm-3">
                        @if ($role->hasPermissionTo($permission->name))
                         <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="permission[]" value="{{$permission->id}}" checked>
                              {{$permission->name}}
                            </label>
                          </div>
                        @else
                         <div class="form-check" value="{{$permission->id}}">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="permission[]" value="{{$permission->id}}">
                                  {{$permission->name}}
                                </label>
                         </div>
                        @endif
                     </div>
                    @endforeach
                   </div>
                </div>
                  @endforeach
              
              <input class="btn btn-outline-primary" type="submit" id="savePermission"value="Save Permission">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop