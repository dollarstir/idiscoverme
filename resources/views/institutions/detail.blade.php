@extends('layouts.main')


@section('content')
<input type="text" id="inid" value="{{$institution->institution_id}}" hidden/>
<input type="text" value="" id="rid" hidden/>
<div class="row">
        <div class="col-12">
                <div class="card">
                  <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-1 mr-4">
                                 <img src="data:image/png;base64,{{$institution->logo}}" alt="" style="max-width:70px" height="60">
                                </div>
                                <div class="col-lg-9">
                                    <h3 id="usertitle" style="line-height:130%">{{$institution->name}}</h3>
                                    <p><i class="mdi mdi-city mr-2"></i>{{$institution->institution_type->name}}</p>
                                </div>
                            </div>

                            <div class="mt-3">
                                    <h6>Address</h6>
                                    <address>
                                        <p>{{$institution->district->region->name}} Region</p>
                                        <p class=" mt-1">{{$institution->district->name}} District</p>
                                        <p>GPS Address: {{$institution->GPS_address}}</p>
                                        <p>P.O Box:</abbr>{{$institution->POBox}}</p>
                                    </address>
                                </div> <!-- end col -->
                        
                            
                        </div><!-- end col -->
                        <div class="col-md-4 offset-md-2">
                            <div class="mt-3 float-right">
                                <p class="m-b-10"><strong>Date Created: </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; {{$institution->created_at}}</span></p>
                                <p class="m-b-10"><strong>Last Updated : </strong> <span class="float-right">{{$institution->created_at}}</span></p>
                            
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-12 mt-4">
                            <div class="alert alert-danger">
                                <div class="mb-1">To start Questionnaire, please make sure you have generated token key for the member.</div>
                                <div class="mb-1">Select member's profile and click on generate token</div>
                                <div class="mb-1">Use <strong>{{url("/$institution->institution_id")}}</strong> to answering the questions</div>
                                <a href='{{url("/$institution->institution_id")}}' class="btn btn-secondary mt-3">Start Questionnaire</a>
                                <a href='#' id="institution_token" class="btn btn-primary mt-3"><span id="istoken">Generate Token</span></a>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                                <div class="row">
                                    <div class="col-md-10"><h4 class="card-title mt-4">{{$institution->institution_type_id}} Members</h4></div>
                                    <div class="col-md-2"><a href='{{url("/member/new/$institution->institution_id")}}' class="btn btn-outline-primary">Add New Member</a></div>
                                </div>
                                <div class="table-responsive">
                                        <table id="example" class="table">
                                                <thead>
                                                  <tr>
                                                      <th>First Name</th>
                                                      <th>Middle Name</th>
                                                      <th>Last Name</th>
                                                      <th>Member ID</th>
                                                      <th>Profile</th>
                                                      <th>Remove</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                </tbody>
                                              </table>
                                </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="row">
                                <div class="col-md-10"><h4 class="card-title mt-4">Marking Scheme</h4></div>
                                <div class="col-md-2"><a href='{{url("/institution/$institution->institution_id/marking/scheme/add")}}' class="btn btn-outline-primary">Add Marking Scheme</a></div>
                            </div>
                            <div class="table-responsive">
                                    <table id="makingscheme" class="table">
                                            <thead>
                                              <tr>
                                                  <th>Level</th>
                                                  <th>Class Score</th>
                                                  <th>Exams Score</th>
                                                  <th>Remove</th>
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

@stop