@extends('layouts.main')


@section('content')
    
<input type="text" value="{{$report->id}}" id="rid" hidden/>
<a href='{{url("/report/$report->id/statistics")}}' class="btn btn-primary mb-2">View Statistics</a>
@if($report->type==0)
    @include('report.generated.summary')
@elseif($report->type==2)
    @include('report.generated.member')
@elseif($report->type==4)
@include('report.generated.institution')
@endif
  
@stop