@extends('layouts.main')


@section('content')
<div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Staff</h4>
          <form class="cmxform" id="AddStaff" method="post">
            <fieldset>
              @if(isset($admin))
                <span id="spk" hidden>{{$admin}}</span>
              @endif
              <div class="form-group">
                    <label for="email">Title</label>
                    <select class="form-control selectpicker" data-live-search="true"  id="title">
                        @foreach ($titles as $title)
                            <option value="{{$title->id}}">{{$title->name}}</option>
                        @endforeach
                    </select>
              </div>
              <div class="form-group">
                <label for="firstname">First Name</label>
                <input id="firstname" class="form-control" name="firstname" type="text">
              </div>
              <div class="form-group">
                <label for="middlename">Middle Name</label>
                <input id="middlename" class="form-control" name="middlename" type="text">
              </div>
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input id="lastname" class="form-control" name="lastname" type="text">
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control selectpicker" data-live-search="true"  id="gender">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
              </div>
              <div class="form-group repeater">
                  <label for="inlineFormInputGroup1">Email Address(s)</label>
                  <div data-repeater-list="group-a">
                      <div data-repeater-item class="d-flex mb-2">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          
                          <input type="email" class="form-control form-control-sm" name="email[]" id="inlineFormInputGroup1" placeholder="">
                        </div>
                        <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn ml-2" >
                          <i class="mdi mdi-delete"></i>
                        </button>
                        <button data-repeater-create type="button" class="btn btn-info btn-sm icon-btn ml-2 mb-2 btnadd">
                            <i class="mdi mdi-plus"></i>
                          </button>
                      </div>
                    </div>
                    
              </div>
              <div class="form-group repeaterphone">
                  <label for="inlineFormInputGroup2">Phone Number(s)</label>
                  <div data-repeater-list="group-b">
                      <div data-repeater-item class="d-flex mb-2">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          
                          <input type="tel" class="form-control form-control-sm" maxlength="10" name="phone[]" id="inlineFormInputGroup2" placeholder="">
                        </div>
                        <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn ml-2" >
                          <i class="mdi mdi-delete"></i>
                        </button>
                        <button data-repeater-create type="button" class="btn btn-info btn-sm icon-btn ml-2 mb-2 btnaddphone">
                            <i class="mdi mdi-plus"></i>
                          </button>
                      </div>
                    </div>
                    
              </div>
              
              <input class="btn btn-primary" type="submit" id="saveStaff" value="Save Staff">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  @stop