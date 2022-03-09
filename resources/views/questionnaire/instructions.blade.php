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
                <form id="wrapped" method="post">
                    <input id="website" name="website" type="text" value="">
                    <!-- Leave for security protection, read docs for details SCC-690054 -->
                    <div id="middle-wizard">

                        

                        <div class="submit step">
                            <h3 class="main_question mb-4">INTRODUCTION</h3>
                            

                            <div class="form-group">
                                The TUCEE Personality Psychometric Test [TPPT] is a well-designed, validated and reliable assessment tool that help to identify your interest, 
                                ability and personality type. The result of this test will help you identify your dominant personality and characteristics in order to make informed
                                decision about all aspects of your life. 
                                Please take your time and select the best option.
                            </div>
                            <h3 class="main_question mb-4 mt-4">INSTRUCTION</h3>
                            <div class="form-group">
                                Please read carefully and simply indicate the extent of your interest for each activity, by circling the appropriate option 
                            </div>
                        </div>
                        <!-- /step-->
                    </div>
                    <!-- /middle-wizard -->
                    <div id="bottom-wizard">
                        <button type="submit" name="process" class="submit">Continue</button>
                    </div>
                    <!-- /bottom-wizard -->
                    @csrf
                </form>
            </div>
            <!-- /Wizard container -->
        </div>
    </div><!-- /Row -->
@stop