@extends('layouts.main')


@section('content')
    
<div class="row">
    <div class="col-lg-8 center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Terminal Report Setup for</h4>
          <form class="cmxform row" id="AddTerminalReport" method="post"><input hidden type="text" value="{{$terminal->id}}" id="trid"/>
            <div class="col-4 mb-4"><strong>Subject</strong></div>
            <div class="col-2 mb-4 text-center"><strong>Class Score (<span id="mscheme_class">{{$terminal->marking_scheme->class_score}}</span>%)</strong></div>
            <div class="col-2 mb-4 text-center"><strong>Exams Score (<span id="mscheme_exams">{{$terminal->marking_scheme->exams_score}}</span>%)</strong></div>
            <div class="col-2 mb-4 text-center"><strong>Total Score (100.00%)</strong></div>
            <div class="col-2 mb-4 text-center"><strong>Position</strong></div>

            <div class="col-12 mb-4"><strong>CORE</strong></div>
            @foreach ($core_subjects as $core_subject)
              <div class="col-4 mb-3" style="line-height:150%;"><input class="subject" type="text" value="{{$core_subject->id}}"hidden/>{{$core_subject->name}}</div>
              <div class="col-2 mb-3 text-center"><input type="text" class="form-control form-control-sm classcore" value="{{$core_subject->terminal_report_score($terminal->id,$core_subject->id)['class_score']}}" autofocus></div>
              <div class="col-2 mb-3"><input type="text" class="form-control form-control-sm examsscore" value="{{$core_subject->terminal_report_score($terminal->id,$core_subject->id)['exams_score']}}"></div>
              <div class="col-2 mb-3"><input type="text" name="totalscore" class="form-control form-control-sm totalscore" disabled value="{{$core_subject->terminal_report_score($terminal->id,$core_subject->id)['total']}}"></div>
              <div class="col-2 mb-3"><input type="text" name="position" class="form-control form-control-sm position" value="{{$core_subject->terminal_report_score($terminal->id,$core_subject->id)['position']}}"></div>
            @endforeach

            <div class="col-12 mb-4"><strong>ELECTIVES</strong></div>
            @foreach ($terminal->level->first()->levet_subjects as $subject)
                <div class="col-4 mb-3" style="line-height:150%;"><input class="subject" type="text" value="{{$subject->subject->id}}"hidden/>{{$subject->subject->name}}</div>
                <div class="col-2 mb-3 text-center"><input type="text" class="form-control form-control-sm classcore" value="{{$subject->terminal_report_score($terminal->id,$subject->subject_id)['class_score']}}"></div>
                <div class="col-2 mb-3"><input type="text" class="form-control form-control-sm examsscore" value="{{$subject->terminal_report_score($terminal->id,$subject->subject_id)['exams_score']}}"></div>
                <div class="col-2 mb-3"><input type="text" name="totalscore" class="form-control form-control-sm totalscore" disabled value="{{$subject->terminal_report_score($terminal->id,$subject->subject_id)['total']}}"></div>
                <div class="col-2 mb-3"><input type="text" name="position" class="form-control form-control-sm position" value="{{$subject->terminal_report_score($terminal->id,$subject->subject_id)['position']}}"></div>
            @endforeach
            <div class="col-12 text-right">
            <input class="btn btn-outline-primary" type="submit" id="saveTR"value="Save Report">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop