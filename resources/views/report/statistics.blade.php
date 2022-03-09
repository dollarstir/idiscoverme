@extends('layouts.main')


@section('content')

<input type="text" value="{{$report->id}}" id="rid" hidden/>
@if($report->type==0)
<div class="row">
    @include('report.statistics.institution')
    @include('report.statistics.member')
</div>
<div class="row mt-3">
    @include('report.statistics.guardian')
    @include('report.statistics.question_setup')
</div>
@elseif($report->type==2)
<div class="row">
    @include('report.statistics.member')
</div>
@elseif($report->type==4)
<div class="row">
    @include('report.statistics.institution')
</div>
@endif
@stop