@extends('layouts.main')


@section('content')
<div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Institution</h4>
          <form class="cmxform" id="saveInstitution" method="post" enctype="multipart/form-data">
            <fieldset>
              
              <div class="form-group">
                <label for="firstname">Name</label>
                <input id="name" class="form-control" name="name" type="text">
              </div>
              <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" data-max-file-size="1M" id="logid" class="dropify" data-allowed-file-extensions="jpg png jpeg" />
            </div>
              
              <div class="form-group">
                    <label for="lastname">P.O. Box</label>
                    <input id="pobox" class="form-control" name="pobox" type="text">
                  </div>
              <div class="form-group">
                <label for="instypeid">Select Institution Type</label>
                <select class="form-control selectpicker" data-live-search="true"  name="instype" title="" id="instypeid" style="color:black">
                  <option selected></option>
                    @foreach ($institutiontypes as $institutiontype)
                        <option value="{{$institutiontype->id}}">{{$institutiontype->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                    <label for="regionid">Select Region</label>
                    <select class="form-control selectpicker" data-live-search="true" name="region" title="" id="regionid" style="color:black">
                        <option selected></option>
                        @foreach ($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="regionid">Select District</label>
                    <select class="form-control selectpicker" data-live-search="true" name="district" title="" id="districtid" style="color:black">
                      <option selected></option>
                        @foreach ($regions->first()->districts()->get() as $district)
                            <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  
              <div class="form-group">
                <label for="lastname">GPS Address</label>
                <input id="gpsaddress" class="form-control" disabled maxlength="14" name="gpsaddress" type="text">
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
              
              <input class="btn btn-primary" type="submit" id="btnSaveInstitution" value="Save Institution">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  @stop