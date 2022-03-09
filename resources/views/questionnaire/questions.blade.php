@extends('layouts.questionnaire')


@section('content')

<div class="row">
        <div class="col-lg-5">
            <div id="left_form">
                <figure><img src="img/registration_bg.svg" alt=""></figure>
                <h2><strong>{{$member->firstName}} {{$member->middleName}} {{$member->lastName}}</strong></h2>
                <p>Member ID: {{$member->member_id}}</p>
                <p>From: {{$institution->name}}</p>
                <a href="#0" hidden id="more_info" data-toggle="modal" data-target="#more-info"><i class="pe-7s-info"></i></a>
            </div>
        </div>
        <div class="col-lg-7">

            <div id="wizard_container">
                <div id="top-wizard">
                    <div id="progressbar"></div>
                </div>
                <!-- /top-wizard -->
                <form name="example-1" id="wrapped" method="POST">
                    <input id="website" name="website" type="text" value="">
                    @if (isset($success))
                        <div class="col-12 mr-3 mt-4 text-center" style="padding:100px 0px">
                            <div><img width="50"src='{{url("/images/checked.svg")}}' /></div>
                            <div class="mt-3"><h2>Congratulations for completing the TUCEE PSYCHOMETRIC TEST!</h2></div>
                            <div><a href='{{url("/$institution->institution_id")}}' class="btn btn-outline-primary py-1 px-3 mt-4">Log Out</a></div>
                        </div>
                    @else
                        @if($question_setup->count() == 1)
                        <!-- Leave for security protection, read docs for details -->
                    
                            
                        <div id="middle-wizard">
                                <input type="number" value="{{$question_setup->first()->questions->count()}}" name="total_questions" hidden/>
                                @foreach ($question_setup->first()->questions as $question)
                                @if($question_setup->first()->questions->count() != $loop->index+1)
                                <div class="step">
                                    <h3 class="main_question"><strong>{{$loop->index+1}}/{{$question_setup->first()->questions->count()}}</strong>{{$question->question}}</h3>
                                    
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group radio_input">
                                                <label class="col-12"><input type="radio" value="1" name="question_{{$loop->index}}" class="icheck required">Strongly Dislike</label>
                                                <label class="col-12"><input type="radio" value="2" name="question_{{$loop->index}}" class="icheck required">Dislike</label>
                                                <label class="col-12"><input type="radio" value="3" name="question_{{$loop->index}}" class="icheck required">Not Sure</label>
                                                <label class="col-12"><input type="radio" value="4" name="question_{{$loop->index}}" class="icheck required">Like</label>
                                                <label class="col-12"><input type="radio" value="5" name="question_{{$loop->index}}" class="icheck required">Strongly Like</label>
                                                <input type="text" name="id_{{$loop->index}}" value="{{$question->id}}" hidden/>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                </div>
                                @else
                                    <div class="submit step">
                                            <h3 class="main_question"><strong>{{$loop->index+1}}/{{$question_setup->first()->questions->count()}}</strong>{{$question->question}}</h3>
                                    
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group radio_input">
                                                            <label class="col-12"><input type="radio" value="1" name="question_{{$loop->index}}" class="icheck required">Strongly Dislike</label>
                                                            <label class="col-12"><input type="radio" value="2" name="question_{{$loop->index}}" class="icheck required">Dislike</label>
                                                            <label class="col-12"><input type="radio" value="3" name="question_{{$loop->index}}" class="icheck required">Not Sure</label>
                                                            <label class="col-12"><input type="radio" value="4" name="question_{{$loop->index}}" class="icheck required">Like</label>
                                                            <label class="col-12"><input type="radio" value="5" name="question_{{$loop->index}}" class="icheck required">Strongly Like</label>
                                                            <input type="text" name="id_{{$loop->index}}" value="{{$question->id}}" hidden/>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                @endif
                            <!-- /step-->
                        @endforeach
                        </div>
                        <!-- /middle-wizard -->
                        <div id="bottom-wizard">
                            <button type="button" name="backward" class="backward">Previous </button>
                            <button type="button" name="forward" class="forward">Next</button>
                            <button type="submit" name="process" class="submit">Submit</button>
                        </div>
                        <!-- /bottom-wizard -->
                        @else
                            <div style="padding:100px 0px"><div class="alert alert-danger mt-4 mr-4 ml-1"><strong>No questions available for you, now!</strong></div></div>
                        @endif
                    @endif
                  @csrf
                </form>
            </div>
            <!-- /Wizard container -->
        </div>
    </div><!-- /Row -->
@stop