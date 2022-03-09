@extends('layouts.main')


@section('content')
<div class="row">
    <div class="col-lg-6 mb-3">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">
              @if(isset($institution))
                Add New Member to {{$institution->name}}<input type="text" value="{{$institution->institution_id}}" id="inid"hidden/>
              @else
                Add New Member
                <input type="text" value="" id="inid" hidden/>
              @endif
              
          </h4>
          <form class="cmxform" id="AddMember" method="post">
            <fieldset>
              
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
                <label for="lastname">Date of Birth</label>
                <div id="datepicker-popup" class="input-group date datepicker">
                  <input type="text" class="form-control" id="dateOfBirth" name="dateOfBirth" value="">
                  <span class="input-group-addon input-group-append border-left">
                    <span class="mdi mdi-calendar input-group-text"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control selectpicker" data-live-search="true" title="" name="gender" id="gender" style="color:#000000">
                    <option selected></option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
              </div>
              
              <h4 class="card-title">Parent/ Guardian Information</h4>
              <div class="form-group">
                    <label for="gpname">Full Name</label>
                    <input id="gpname" class="form-control" name="gpname" type="text" placeholder="Firstname  Lastname">
              </div>
              <div class="form-group">
                    <label for="email">Select Type</label>
                    <select class="form-control selectpicker" data-live-search="true" title="" name="gptype" id="gptype" style="color:black">
                        <option selected></option>
                        <option value="0">Parent (Mother)</option>
                        <option value="1">Parent (Father)</option>
                        <option value="2">Guardian</option>
                    </select>
              </div>
              <div class="form-group repeaterphone">
                  <label for="inlineFormInputGroup2">Phone Number(s)</label>
                  <div data-repeater-list="group-b">
                      <div data-repeater-item class="d-flex mb-2">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          
                          <input type="tel" class="form-control form-control-sm" maxlength="10" name="phone[]" id="inlineFormInputGroup2" placeholder="">
                        </div>
                        <button data-repeater-delete type="button" class="btn btn-outline-danger btn-sm icon-btn ml-2" >
                          <i class="mdi mdi-delete"></i>
                        </button>
                        <button data-repeater-create type="button" class="btn btn-outline-info btn-sm icon-btn ml-2 mb-2 btnaddphone">
                            <i class="mdi mdi-plus"></i>
                          </button>
                      </div>
                    </div>
                    
              </div>
              
              <input class="btn btn-outline-primary" type="submit" id="saveStaff" value="Save Information">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                        <h4 class="card-title">Import CSV <a class="ml-4" href="{{url('/download/add_member_template')}}">Download Template</a></h4>
                        
                        <form class="cmxform" id="importFile" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                    <label for="importcsv">Select File</label>
                                    <input type="file" name="importcsv" id="importcsv" class="dropify" accept=".csv" data-allowed-file-extensions='["csv"]'/>
                            </div>
                            <input class="btn btn-outline-primary" type="submit" id="import" value="Import">
                        </form>
                </div>
            </div>
            
    </div>
</div>

@stop