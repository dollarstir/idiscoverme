@extends('layouts.main')


@section('content')
<input type="text" id="inid" value="{{$event->institution_id}}" hidden/>
<div class="row">
        <div class="col-12">
                <div class="card">
                  <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h3 id="usertitle" style="line-height:130%">{{strtoupper($event->name)}}</h3>
                                    <p><i class="mdi mdi-information-outline mr-2" title="Description"></i>{{$event->Description}}</p>
                                </div>
                            </div>

                            <div class="mt-3">
                                    <h6>Event Information</h6>
                                    <address class="mt-3">
                                        <div class="mb-2"><i class="mdi mdi-format-list-bulleted-type  mr-2"></i> {{$event->privacy}}</div>
                                        <div class="mb-2"><i class="mdi mdi-calendar mr-2"></i> {{date('M d, Y h:i a', strtotime($event->start_at))}}</div>
                                        <div class="mb-2"><i class="mdi mdi-calendar mr-2"></i> {{date('M d, Y h:i a', strtotime($event->end_at))}}</div>
                                    </address>
                                </div> <!-- end col -->
                        
                            
                        </div><!-- end col -->
                        <div class="col-md-4 offset-md-2">
                            <div class="mt-3 float-right">
                                <p class="m-b-10"><strong>Date Created: </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; {{$event->created_at}}</span></p>
                                <p class="m-b-10"><strong>Last Updated : </strong> <span class="float-right">{{$event->created_at}}</span></p>
                            
                            </div>
                        </div><!-- end col -->

                        @if($event->privacy=="Custom")
                        <div class="col-md-12 mt-4">
                                <div class="row">
                                    <div class="col-md-10"><h4 class="card-title mt-4">{{$event->institution_type_id}} Members</h4></div>
                                    
                                    <div class="col-md-2"><a href='{{url("/member/new/$event->institution_id")}}' class="btn btn-outline-primary">Add New Member</a></div>
                                    
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
                    @endif


                    </div>
                  </div>
                </div>
        </div>
</div>

@stop