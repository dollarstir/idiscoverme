@extends('layouts.main')


@section('content')
    
<input type="text" value="{{$guardian->id}}" id="gid" hidden/>
<input type="text" value="" id="rid" hidden/>
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="text-center pb-4">
                    <img src="{{url('/images/avatar.png')}}" alt="profile" class="img-lg rounded-circle mb-3"/>
                    <div class="mb-3">
                      <h3><span id="profilename">{{$guardian->fullName}}</span> <a href='{{url("/guardian/$guardian->id/edit")}}' class="editprofile"><i class="mdi mdi-grease-pencil ml-2"></i></a></h3>
                      <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0 mr-2 text-muted">Guardian ID: {{$guardian->id}}</h5>
                        
                      </div>
                    </div>
                  </div>
                  <div class="border-bottom py-1 mt-4">
                        <h4 class="card-title">Personal Information</h4>
                  </div>
                  <div class="py-4">
                    <p class="clearfix">
                      <span class="float-left">
                        Account Status
                      </span>
                      <span class="float-right text-muted">
                        Active
                      </span>
                    </p>
                    
                    <p class="clearfix">
                            <span class="float-left">
                              Type
                            </span>
                            <span class="float-right text-muted">
                              {{$guardian->type}}
                            </span>
                    </p>
                    <p class="clearfix">
                            <span class="float-left">
                              Registered At
                            </span>
                            <span class="float-right text-muted">
                              {{$guardian->created_at}}
                            </span>
                    </p>
                  </div>
                  
                </div>
                <div class="col-lg-8">
                      <div class="row">
                       
                       <div class="col-lg-12">
                            <h4 class="card-title mt-4"><i class="mdi mdi-account-multiple-outline mr-2"></i>Wards
                              </h4>
                            <div class="table-responsive">
                                    <table id="wards" class="table">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Member ID</th>
                                            <th>Gender</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                       </div>
                      
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
</div>
@stop