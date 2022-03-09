@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-6 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Career</h4>
          <input type="text" value="{{$personality->id}}" id="cid" hidden/>
          <input type="text" value="{{$careerpath->id}}" id="cpid" hidden/>
          <form class="cmxform" id="AddCareer" method="post">
            <fieldset>
                <div class="form-group repeater">
                    <label for="inlineFormInputGroup1">Career Name</label>
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="d-flex mb-2">
                          <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            
                            <input type="text" class="form-control form-control-sm" autofocus name="careers[]" id="inlineFormInputGroup1" placeholder="">
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
              
              <input class="btn btn-outline-primary mt-4" type="submit" id="saveCareer"value="Save">
            </fieldset>
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
@stop