@extends('layouts.main')


@section('content')
    
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Institution(s) to {{$member->firstName}} {{$member->middleName}} {{$member->lastName}}</h4>
      <div class="row"><input type="text" id="mid" value="{{$member->member_id}}" hidden/>
        <div class="col-12">
          <div class="table-responsive">
            <table id="addmembers" class="table">
              <thead>
                <tr>
                    <th><input type="checkbox" class="select_all" name="selectall"/></th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Institution Type</th>
                    <th>District</th>
                    <th>GPS Address</th>
                    <th>P.O. Box</th>
                    <th>Information</th>
                </tr>
              </thead>
              <tbody>
               
                
              </tbody>
            </table>
            
          </div>
        </div>
        <div class="col-12 mt-4">
                <a href="#" class="btn btn-outline-primary add_institution">Add Institutions</a>
        </div>
      </div>
    </div>
  </div>
@stop