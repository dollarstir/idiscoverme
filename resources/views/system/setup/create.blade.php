@extends('layouts.setup')


@section('content')
<div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">System Setup</h4>
          <form class="cmxform" id="saveSystemInfo" method="post" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <label for="softwareName">Software Name</label>
                <input id="softwareName" class="form-control" name="softwareName" autofocus type="text">
              </div>
              <div class="form-group">
                <label for="softwareShortName">Software Short Name</label>
                <input id="softwareShortName" class="form-control" name="softwareShortName" type="text">
              </div>
              <div class="form-group">
                <label for="organizationName">organization Name</label>
                <input id="organizationName" class="form-control" name="organizationName" type="text">
              </div>
              <div class="form-group">
                    <label for="organz_logo">Organization Logo</label>
                    <input type="file" name="organz_logo" id="organz_logoid" class="dropify" required/>
            </div>
              <div class="form-group">
                    <label for="homepagelogo">Homepage Logo</label>
                    <input type="file" name="homepagelogo" id="homepagelogoid" class="dropify" required/>
            </div>
            <div class="form-group">
              <label for="headerlogo">Header Logo</label>
              <input type="file" name="headerlogo" id="headerlogoid" class="dropify" required/>
            </div>
            <div class="form-group">
              <label for="favicon">Favicon</label>
              <input type="file" name="favicon" id="favicongoid" class="dropify" required/>
            </div>
              <div class="form-group">
                <label for="color">Organization Color</label>
                <input type="text" class="color-picker" style="width:100%;" id="color" value="#ffe74c" />
              </div>
              <div class="form-group">
                <label for="location">Organization Location</label>
                <input id="location" class="form-control" name="location" type="text">
              </div>
              <div class="form-group">
                <label for="lastname">Organization GPS Address</label>
                <input id="gpsaddress" class="form-control" name="gpsaddress" type="text">
              </div>
              <div class="form-group">
                    <label for="lastname">Organization P.O. Box</label>
                    <input id="pobox" class="form-control" name="pobox" type="text">
                  </div>
              
              
              <div class="form-group repeater">
                  <label for="inlineFormInputGroup1">Organization Email Address(s)</label>
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
                  <label for="inlineFormInputGroup2">Organization Phone Number(s)</label>
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
              
              <input class="btn btn-primary" type="submit" id="btnSaveSystemInfo" value="Save Information">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  @stop