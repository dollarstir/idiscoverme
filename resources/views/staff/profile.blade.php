@extends('layouts.main')


@section('content')
    
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="border-bottom text-center pb-4">
                    
                    <input type="text" value="{{$staff->id}}" id="sid" hidden/>
                    <img src="{{url('/images/avatar.png')}}" alt="profile" class="img-lg rounded-circle mb-3"/>
                    <div class="mb-3">
                      <h3><span id="profilename">{{$staff->firstName}} {{$staff->middleName}} {{$staff->lastName}}</span><a href='{{url("/staff/$staff->id/edit")}}' class="editprofile"><i class="mdi mdi-grease-pencil ml-2"></i></a></h3>
                      <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0 mr-2 text-muted">Staff ID: {{$staff->id}}</h5>
                        
                      </div>
                    </div>
                    <p class="w-75 mx-auto mb-3"> Role(s): {{ implode(', ',$staff->roles()->get()->pluck('name')->toArray()) }} </p>
                    <div class="d-flex justify-content-center">
                      @if (Auth::user()->id == $staff->id)
                          <a href='{{url("/reset/password")}}' class="btn btn-outline-primary mr-1">Change Password</a>
                      @endif
                      @if(Auth::user()->can("Assign Role"))
                            <a href='{{url("/staff/$staff->id/roles")}}' class="btn btn-outline-info mr-1">Manage Role</a>
                      @endif
                      @if(Auth::user()->can("Delete Staff"))
                          <a href="#" class="btn btn-outline-danger">Delete Account</a>
                      @endif
                    </div>
                  </div>
                  <div class="border-bottom py-4">
                        <p>Personal Information</p>
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
                              Gender
                            </span>
                            <span class="float-right text-muted">
                              {{$staff->gender}}
                            </span>
                          </p>
                    <p class="clearfix mt-3">
                      <span class="float-left">
                        Phone <a href="#" class="addphone ml-1" title="Add New Phone Number"><i class="mdi mdi-plus"></i></a>
                      </span>
                      <span class="float-right text-muted">
                        @foreach ($staff->user_contacts as $contact)
                            <span class="float-right text-muted phone" id="con{{$contact->id}}">
                                <a href="tel:{{$contact->phoneNumber}}" id="phe{{$contact->id}}">{{$contact->phoneNumber}}</a>
                                @if (Auth::user()->id == $staff->id || Auth::user()->can("Edit Staff"))
                                <a href="#" class="editphone" id="ph{{$contact->id}}" data-id="{{$contact->id}}" data-phone="{{$contact->phoneNumber}}"><i class="mdi mdi-pencil"></i></a>
                                @endif
                                @if (Auth::user()->id == $staff->id || Auth::user()->can("Delete Staff"))
                                <a href="#" class="deletephone" id="del{{$contact->id}}" data-id="{{$contact->id}}" data-phone="{{$contact->phoneNumber}}"><i class="mdi mdi-delete"></i></a>
                                @endif
                                <br/>
                            </span>
                            
                            <br/>
                        @endforeach
                      </span>
                    </p>
                    <p class="clearfix mt-3">
                      <span class="float-left">
                        Email Address <a href="#" class="addmail ml-1" title="Add New Email Address"><i class="mdi mdi-plus"></i></a>
                      </span>
                      <span class="float-right text-muted" id="emails">
                       @foreach ($staff->user_email_addresses as $email)
                       <span class="float-right text-muted mail" id="ml{{$email->id}}">
                          <a href="mailto:{{$email->address}}">{{$email->address}}</a>
                          @if (Auth::user()->id == $staff->id || Auth::user()->can("Edit Staff"))
                            <a href="#" class="editmail" id="em{{$email->id}}" data-id="{{$email->id}}" data-mail="{{$email->address}}"><i class="mdi mdi-pencil"></i></a>
                          @endif
                          @if (Auth::user()->id == $staff->id || Auth::user()->can("Edit Staff"))
                            <a href="#" class="deletemail" id="em{{$email->id}}" data-id="{{$email->id}}" data-mail="{{$email->address}}"><i class="mdi mdi-delete"></i></a>
                          @endif
                          <br/>
                       </span>
                       <br/>  
                       @endforeach
                      </span>
                    </p>
                    <p class="clearfix">
                            <span class="float-left">
                              Registered At
                            </span>
                            <span class="float-right text-muted">
                              {{$staff->created_at}}
                            </span>
                          </p>
                  </div>
                </div>
                <div class="col-lg-8">
                      <div class="row">
                       <div class="col-lg-12"> <div id="calendar" class="full-calendar"></div></div>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@stop