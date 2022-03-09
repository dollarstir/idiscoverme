@extends('layouts.questionnaire')


@section('content')

<div class="row">
        <div class="col-lg-5">
            <div id="left_form">
                <figure><img width="100" src="data:image/png;base64,{{$institution->logo}}" /></figure>
                <h2><strong>{{$institution->name}}</strong></h2>
                <p>{{$institution->location}}</p>
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
                    <!-- Leave for security protection, read docs for details -->
                    <div id="middle-wizard">

                        

                        <div class="submit step">
                            <h3 class="main_question mb-4">Enter token to continue</h3>
                            @if (session()->has('error'))
                            <div class="form-group">
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            </div>
                            @endif

                            <div class="form-group">
                                <input class="form-control p-2 required" minlength="6" name="token" id="tokenkey" style="border:1px solid #cccccc" value="" autofocus placeholder="Enter token key here...."/>
                            </div>
                            <div class="form-group terms">
                                <label>You will be given token from the school administration.</label>
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