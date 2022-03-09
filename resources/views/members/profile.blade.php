@extends('layouts.main')


@section('content')
    
<input type="text" value="{{$member->member_id}}" id="sid" hidden/>
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
                      <h3><span id="profilename">{{$member->firstName}} {{$member->middleName}} {{$member->lastName}}</span> <a href='{{url("/member/$member->member_id/edit")}}' class="editprofile"><i class="mdi mdi-grease-pencil ml-2"></i></a></h3>
                      <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0 mr-2 text-muted">member ID: {{$member->member_id}}</h5>
                        <button class="btn" id="copytoken" data-clipboard-text="ust because you can" hidden></button>
                      </div>
                    </div>
                    <div class="d-flex justify-content-center">
                      <a href="#" class="btn btn-outline-danger" id="deleteMemberAccount">Delete Account</a>
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
                              Gender
                            </span>
                            <span class="float-right text-muted">
                              {{$member->gender}}
                            </span>
                          </p>
                    <p class="clearfix">
                            <span class="float-left">
                              Date of Birth
                            </span>
                            <span class="float-right text-muted">
                              {{$member->dateOfBirth}}
                            </span>
                    </p>
                    <p class="clearfix">
                            <span class="float-left">
                              Registered At
                            </span>
                            <span class="float-right text-muted">
                              {{$member->created_at}}
                            </span>
                    </p>
                  </div>
                  <div class="border-bottom py-1 mt-3">
                        <h4 class="card-title">Parent/Guardian Information</h4>
                  </div>
                  <div class="py-4">
                        @foreach ($member->member_guardian as $guardian)
                        <p class="clearfix">
                                <span class="float-left">
                                  Full Name
                                </span>
                                <span class="float-right text-muted">
                                  {{$guardian->guardian->fullName}}
                                </span>
                              </p>
                              <p class="clearfix">
                                    <span class="float-left">
                                      Type
                                    </span>
                                    <span class="float-right text-muted">
                                      {{$guardian->guardian->type}}
                                    </span>
                               </p>
                               <p class="clearfix">
                                    <span class="float-left">
                                      Phone Number(s)
                                    </span>
                                    
                                      @foreach ($guardian->guardian->phone_numbers as $phone)
                                        <span class="float-right text-muted">
                                          {{$phone->phoneNumber}} <a href="tel:{{$phone->phoneNumber}}"title="Call {{$phone->phoneNumber}}"><i class="mdi mdi-phone-forward ml-2"></i></a><br/>
                                        </span>
                                        
                                      @endforeach
                                      
                                    
                               </p>
                      
                      
                        @endforeach
                  </div>
                </div>
                <div class="col-lg-8">
                      <div class="row">
                       
                       <div class="col-lg-12">
                            <h4 class="card-title mt-4"><i class="mdi mdi-city mr-2"></i>Institutions
                              <a href='{{url("/member/$member->member_id/institutions/add")}}' class="ml-1" title="Add Institution"><i class="mdi mdi-plus"></i></a>
                            </h4>
                            <div class="table-responsive">
                                    <table id="institutions" class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Logo</th>
                                            <th>Institution <br/><br/>Type</th>
                                            <th>Information</th>
                                            <th>Generate<br/><br/> Token</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                       </div>
                       <div class="col-lg-12 mt-4">
                            <h4 class="card-title mt-4"><i class="mdi mdi-file"></i>Question Answered</h4>
                            <div class="table-responsive">
                                    <table id="questionreport" class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Created At</th>
                                            <th>Question <br/><br />Report</th>
                                            <th>Terminal<br /><br />Report</th>
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