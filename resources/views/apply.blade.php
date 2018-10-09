@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" data-dismiss="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ Session::get('success') }}
        </div>
    @endif
    <div class="alert alert-warning alert-dismissible" id="confrence-info" role="alert" style="display:none">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="conferenceHTML"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Request a Conference</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="new-conference-form">
                                <img align="middle" src="{{ asset('assets/images/stage1.png')}}" class="image-staging"/>
                                
                                <form id="newConfReqForm" name="newConfReqForm" method="post" class="form" novalidate="novalidate">
                                    <div class="row first-page">
                                        <div class="col-md-6 col-md-offset-3">
                                        <div class="col-md-12 form-text">Please fill out the request below. Read-only fields can be edited by clicking on them</div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="user_id" value="{{Cookie::get('uid')}}"/>
                                                <input type="hidden" name="conferenceid" value="{{$conference->id}}"/>

                                                @if(Cookie::get('ufn'))
                                                <div class="form-group prefilled">
                                                @else
                                                <div class="form-group">
                                                @endif
                                                    <label class="control-label" for="firstname"><b>Your First Name</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" value="{{Cookie::get('ufn')}}" tabindex="1" id="firstname" maxlength="25" class="form-control rmv-box" name="firstname"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                @if(Cookie::get('uln'))
                                                <div class="form-group prefilled">
                                                @else
                                                <div class="form-group">
                                                @endif
                                                    <label class="control-label" for="lastname"><b>Your Last Name</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" value="{{Cookie::get('uln')}}" class="form-control rmv-box" tabindex="2" name="lastname" id="lastname"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                @if(Cookie::get('uphone'))
                                                <div class="form-group prefilled">
                                                @else
                                                <div class="form-group">
                                                @endif
                                                    <label class="control-label" for="phone"><b>Your Phone Number</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" value="{{Cookie::get('uphone')}}" tabindex="3" class="form-control rmv-box" maxlength="13" name="phone" id="phone"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                @if(Cookie::get('uanotherphone'))
                                                <div class="form-group prefilled">
                                                @else
                                                <div class="form-group">
                                                @endif
                                                    <label class="control-label" for="another_phone"><b>Add Another Phone Number</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" value="{{Cookie::get('uanotherphone')}}" class="form-control rmv-box" tabindex="4" maxlength="13" name="another_phone" id="another_phone"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                @if(Cookie::get('uemail'))
                                                <div class="form-group prefilled">
                                                @else
                                                <div class="form-group">
                                                @endif
                                                    <label class="control-label" for="email"><b>Your Email Address</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" value="{{Cookie::get('uemail')}}" tabindex="5" class="form-control rmv-box" name="email" id="email"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                @if(Cookie::get('uanotheremail'))
                                                <div class="form-group prefilled">
                                                @else
                                                <div class="form-group">
                                                @endif
                                                    <label class="control-label" for="another_email"><b>Add Another Email Address</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" value="{{Cookie::get('uanotheremail')}}" class="form-control rmv-box" tabindex="6" name="another_email" id="another_email"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                <div class="form-group prefilled">
                                                    <label class="control-label" for="confname"><b>Conference Name</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" tabindex="7" value="{{$conference->conferencename}}" class="form-control rmv-box" maxlength="350" id="confname" name="confname"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group prefilled">
                                                    <label class="control-label" for="confurl"><b>Conference Website URL</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="url" placeholder="http://www.nrg.com" class="form-control rmv-box" value="{{$conference->conferenceurl}}" tabindex="8" name="confurl" id="confurl"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="conf_frequency"><b>Conference Frequency</b></label>
                                                    <div class="survey-form-fields">
                                                        <select class="form-control" tabindex="9" id="conf_frequency" name="conf_frequency">
                                                            <option value="">Select</option>
                                                            <option value="LOY">Less than once a Year</option>
                                                            <option value="OAY">Once a Year</option>
                                                            <option value="MTY">Multiple times a Year</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="mngemail"><b>Approval Manager Email</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" value="{{Cookie::get('memail')}}" class="form-control" tabindex="10" name="mngemail" id="mngemail"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="conf_cost"><b>Conference Cost</b></label>
                                                    <div class="survey-form-fields">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="text" maxlength="10" class="form-control" tabindex="11" name="conf_cost" id="conf_cost"/>
                                                        </div> 
                                                    </div>
                                                    <div class="error_hand_conf_cost"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="travel_cost"><b>Travel & Expenses Cost</b></label>
                                                    <div class="survey-form-fields">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="text" maxlength="10" class="form-control" tabindex="12" id="travel_cost" name="travel_cost"/>
                                                        </div> 
                                                    </div>
                                                    <div class="error_hand_travel_cost"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="conf_location"><b>Conference Location</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" class="form-control" tabindex="13" name="conf_location" id="conf_location"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="conf_city"><b>Travel City</b></label>
                                                    <div class="survey-form-fields">
                                                        <input type="text" class="form-control" tabindex="14" name="conf_city" id="conf_city"/>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                <div class="form-group conf-start prefilled">
                                                    <label class="control-label" for="conf_start">Conference Dates</label>
                                                    <div class="survey-form-fields">
                                                        <span class="date-field-label">Start</span>
                                                        <span class="date-field">
                                                            <input type="text" value="{{$conf_start}}" class="form-control rmv-box" tabindex="15" name="conf_start" id="conf_start" placeholder= "MM/DD/YYYY"/>
                                                        </span>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group conf-end prefilled">
                                                    <label class="control-label" for="conf_end"><b></b></label>
                                                    <div class="survey-form-fields">
                                                        <span class="date-field-label">End</span>
                                                        <span class="date-field">
                                                            <input type="text" value="{{$conf_end}}" class="form-control rmv-box" tabindex="16" name="conf_end" id="conf_end" placeholder= "MM/DD/YYYY"/>
                                                        </span>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-6">
                                                <div class="form-group travel-start">
                                                    <label class="control-label" for="travel_start"><b>Travel Dates</b></label>
                                                    <div class="survey-form-fields">
                                                        <span class="date-field-label">Start</span>
                                                        <span class="date-field">
                                                            <input type="text" class="form-control" tabindex="17" name="travel_start" id="travel_start" placeholder= "MM/DD/YYYY"/>
                                                        </span>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group travel-end">
                                                    <label class="control-label" for="travel_end"><b></b></label>
                                                    <div class="survey-form-fields">
                                                        <span class="date-field-label">End</span>
                                                        <span class="date-field">
                                                            <input type="text" class="form-control" tabindex="18" name="travel_end" id="travel_end" placeholder= "MM/DD/YYYY"/>
                                                        </span>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group col-sm-12 text-right survey-go-back go-at-first">
                                                @if(Cookie::get('uid'))
                                                <a href="{{route('user')}}" class="btn survey-btn btn-default btn-md">Go Back</a>
                                                @else
                                                <a href="{{route('/')}}" class="btn survey-btn btn-default btn-md">Go Back</a>
                                                @endif
                                                <button class="btn submit survey-btn btn-info btn-md" type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </span>

                            <span class="new-conference-form-two">
                                <img align="middle" src="{{ asset('assets/images/stage2.png')}}" class="image-staging"/>
                                <form name="newConfReqFormTwo" id="newConfReqFormTwo" method="post" class="form-horizontal" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="col-md-12 form-group">Please fill out the request below. Read-only fields can be edited by clicking on them</div>

                                            <div class="form-group">
                                                <label class="control-label" for="attendees_travelling"><b>Please list the names of all NRG employees traveling with you.</b></label>
                                                <div class="survey-form-fields">
                                                    <textarea id="attendees_travelling" placeholder="Example: Jane Doe, John Smith, Mary Smith, Sam Doe" class="form-control col-md-4" name="attendees_travelling"></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="form-group prefilled">
                                                <label class="control-label" for="description"><b>Conference Description</b></label>
                                                <div class="survey-form-fields">
                                                    <textarea id="description" class="form-control col-md-4 rmv-box" name="description" required>{{$conference->description}}</textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group error_hand_description"></div>

                                            <div class="form-group">
                                                <label class="control-label"><b>What would your role be at the conference?</b></label>
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="role" id="Attending" value="Attending" required/>Attending
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="role" id="Exhibiting" value="Exhibiting" required/>Exhibiting
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="role" id="Speaking" value="Speaking" required/>Speaking
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="role" id="Sponsoring" value="Sponsoring" required/>Sponsoring
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group error_hand_role"></div>

                                            <span class="elaborate-on-sponsoring">
                                                <div class="form-group">
                                                    <label class="control-label" for="sponsoring_cost"><b>What is the sponsoring cost?</b></label>
                                                    <div class="survey-form-fields costs">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="text" maxlength="10" id="sponsoring_cost" value="{{$conference->sponsoring_cost}}" class="form-control col-md-3" name="sponsoring_cost" required/>
                                                        </div> 
                                                    </div>
                                                    <div class="error_hand_sponsoring_cost"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label" for="benefits"><b>What are the benefits?</b></label>
                                                    <div class="survey-form-fields">
                                                        <textarea id="benefits" class="form-control" name="benefits" required></textarea>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label" for="deliverables"><b>What deliverables are needed?</b></label>
                                                    <div class="survey-form-fields">
                                                        <textarea id="deliverables" class="form-control" name="deliverables" required></textarea>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </span>
                                                        
                                            <div class="form-group survey-go-back pull-right">
                                                <a href="javascript:void(0);" class="btn survey-btn btn-default go-back-one btn-md">Go Back</a>
                                                <button class="btn submit survey-btn btn-info btn-md" type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </span>

                            <span class="new-conference-form-three">
                                <img align="middle" src="{{ asset('assets/images/stage3.png')}}" class="image-staging"/>
                                <form name="newConfReqFormThree" id="newConfReqFormThree" method="post" class="form-horizontal" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group">Please fill out the request below. Read-only fields can be edited by clicking on them</div>

                                            <div class="form-group">
                                                <label class="control-label" for="business"><b>Why is this conference relevant, i.e. what business goal does it fulfill?</b></label>
                                                <div class="survey-form-fields">
                                                    <textarea id="business" class="form-control col-md-4" name="business" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group error_hand_business"></div>

                                            <div class="form-group">
                                                <label class="control-label"><b>What industries/verticals does this conference focus on?</b></label>
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="industry" value="Option 1" required/>Option 1
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="industry" value="Option 2" required/>Option 2
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="industry" value="Option 3" required/>Option 3
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="industry" value="Other industry/vertical focus not mentioned above" required/>Other industry/vertical focus not mentioned above
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group error_hand_industry"></div>

                                            <div class="form-group">
                                                <label class="control-label" for="audience"><b>Who is the audience and what prospects/leads are attending?</b></label>
                                                <div class="survey-form-fields">
                                                    <textarea id="audience" class="form-control" name="audience" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="form-group survey-go-back pull-right">
                                                <a href="javascript:void(0);" class="btn survey-btn btn-default go-back-two btn-md">Go Back</a>
                                                <button class="btn submit survey-btn btn-info btn-md" type="submit">Submit</button>
                                            </div>

                                            <div id='model_loadingmessage' style='display:none'>
                                                <img src="{{ asset('assets/images/loader.gif') }}"/>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </span>
                            
                            <span class="thank-you text-center">
                                <img align="middle" src="{{ asset('assets/images/stage4.png')}}" class="image-staging-four"/>
                                <p>Thank you for filling out the request!</p>
                                @if(Cookie::get('uid'))
                                <div class="text-center-button"><a href="{{route('user')}}" class="btn back survey-btn btn-info btn-md">Back to My Dashboard</a></div>
                                @else
                                <div class="text-center-button"><a href="{{route('/')}}" class="btn back survey-btn btn-info btn-md">Back to My Dashboard</a></div>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript">
$('.new-conference-form-two').hide();
$('.elaborate-on-sponsoring').hide();
$('.new-conference-form-three').hide();
$('.thank-you').hide();

$('.go-back-one').click(function(){
    $('.new-conference-form').show();
    $('.new-conference-form-one').hide();
    $('.elaborate-on-sponsoring').hide();
    $('.new-conference-form-three').hide();
    $('.new-conference-form-two').hide();
    $('.thank-you').hide();
});

$('.go-back-two').click(function(){
    $('.new-conference-form-one').hide();
    $('.elaborate-on-sponsoring').hide();
    $('.new-conference-form-two').show();
    $('.new-conference-form-three').hide();
    $('.thank-you').hide();
});

$('.rmv-box').click(function(){
    $(this).css({
        'border-color' : '',
        'box-shadow' : ''
    });
    $(this).parent().prev().parent().removeClass('prefilled');
});

$('input[name="conf_start"]').click(function(){
    $(this).css({
        'border-color' : '',
        'box-shadow' : ''
    });
    $(this).parent().prev().parent().prev().parent().removeClass('prefilled');
});

$('input[name="conf_end"]').click(function(){
    $(this).css({
        'border-color' : '',
        'box-shadow' : ''
    });
    $(this).parent().prev().parent().prev().parent().removeClass('prefilled');
});

$("input[name='role']").change(function(){
    if($(this).val() == "Sponsoring"){
        $(".elaborate-on-sponsoring").show();
    }
    else{
        $(".elaborate-on-sponsoring").hide();
    }
});

$("input[name='role']").change(function(){
    $('#role-error').hide();
});

$("input[name='nrg_past']").change(function(){
    $('#nrg_past-error').hide();
});

$("input[name='industry']").change(function(){
    $('#industry-error').hide();
});

$("form[name=newConfReqForm]").validate({
    errorClass: "my-error-class",
    focusInvalid: false,
    ignore: [],
    rules :{
        firstname :{
            required:true
        },
        phone :{
            required:true,
            phone:true
        },
        email :{
            required:true
        },
        confname :{
            required:true
        }, 
        conf_frequency :{
            required:true
        },
        conf_cost :{
            required:true,
            costs:true
        },
        travel_cost :{
            costs:true
        },
        conf_location :{
            required:true
        },
        conf_start :{
            required:true
        },
        travel_start :{
            required: function(element) {
                return $('#travel_cost').val().length > 0
            }
        },
        lastname :{
            required:true
        },
        mngemail : {
            required: true
        },
        conf_city: {
            required: function(element) {
                return $('#travel_cost').val().length > 0
            }
        },
        conf_end : {
            required: true
        },
        travel_end : {
            required: function(element) {
                return $('#travel_cost').val().length > 0
            }
        },
    },
    messages : {
        firstname :{
            required: "Please enter your first name",
        },
        phone :{
            required: "Please enter your phone number"
        },
        email :{
            required: "Please enter your email"
        },
        confname :{
            required: "Please enter conference name",
        },
        conf_frequency :{
            required: "Please enter conference frequency",
        },
        conf_cost :{
            required: "Please enter conference cost",
        },
        conf_location :{
            required: "Please enter conference location",
        },
        conf_start :{
            required: "Please enter start date",
        },
        travel_start :{
            required: "Please enter start date",
        },
        lastname :{
            required: "Please enter your last name",
        },
        mngemail : {
            required: "Please enter your manager email",
        },
        conf_city : {
            required: "Please enter travel city",
        },
        conf_end : {
            required: "Please enter end date",
        },
        travel_end : {
            required: "Please enter end date",
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "conf_start" ) {
          error.insertAfter('.conf-start');
        }else if (element.attr("name") == "travel_start") {
          error.insertAfter('.travel-start');
        }else if (element.attr("name") == "conf_end") {
          error.insertAfter('.conf-end');
        }else if (element.attr("name") == "travel_end") {
          error.insertAfter('.travel-end');
        }else if (element.attr("name") == "conf_cost") {
          error.insertAfter('.error_hand_conf_cost');
        }else if (element.attr("name") == "travel_cost") {
          error.insertAfter('.error_hand_travel_cost');
        }
        else {
          error.insertAfter(element);
        }    
    },
    submitHandler:function(form) {
        $('.new-conference-form').hide();
        $('.new-conference-form-two').show();
        $('.new-conference-form-three').hide();
        $('.thank-you').hide();
    },
});

jQuery.validator.addMethod("phone", function( value, element ) {
    var regex = new RegExp("^(?=.*[0-9])[- +()0-9]{13}$");
    var key = value;
    if (!regex.test(key) && value != '') {
    return false;
    }
    return true;
}, "Please enter valid phone number.");

jQuery.validator.addMethod("costs", function( value, element ) {
    var regex = new RegExp("^[+-]?([0-9]*[.])?[0-9]+$");
    var key = value;
    if (!regex.test(key) && value != '') {
    return false;
    }
    return true;
}, "Please enter numbers only");

$("form[name=newConfReqFormTwo]").validate({
    errorClass: "my-error-class",
    rules :{
        description :{
            required:true
        },
        role :{
            required:true
        },
        sponsoring_cost :{
            required:true,
            costs:true
        },
        benefits :{
            required:true
        },
        deliverables :{
            required:true
        },
    },
    messages : {
        description :{
            required: "Please enter conference description",
        },
        role :{
            required: "Please select your role at the conference",
        },
        sponsoring_cost :{
            required: "Please enter sponsoring cost",
        },
        benefits :{
            required: "Please enter benefits of sponsoring",
        },
        deliverables :{
            required: "Please enter deliverables needed",
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "role" ) {
          error.appendTo('.error_hand_role');
        }
        else if (element.attr("name") == "description") {
          error.appendTo('.error_hand_description');
        }
        else if (element.attr("name") == "sponsoring_cost") {
          error.appendTo('.error_hand_sponsoring_cost');
        }
        else {
          error.insertAfter(element);
        }    
    },
    submitHandler:function(form) {
        $('.new-conference-form').hide();
        $('.new-conference-form-two').hide();
        $('.new-conference-form-three').show();
        $('.thank-you').hide();
    },
});

$("form[name=newConfReqFormThree]").validate({
    errorClass: "my-error-class",
    rules :{
        business :{
            required:true
        },
        industry :{
            required:true
        },
        audience :{
            required:true
        },
    },
    messages : {
        business :{
            required: "Please enter this field",
        },
        industry :{
            required: "Please select anyone of this fields",
        },
        audience :{
            required: "Please enter this field",
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "business" ) {
          error.appendTo('.error_hand_business');
        }
        else if (element.attr("name") == "industry") {
          error.appendTo('.error_hand_industry');
        }
        else {
          error.insertAfter(element);
        }    
    },
    submitHandler:function(form) {
        $('#model_loadingmessage').show();
        $('body').addClass("loading");
        var formData = new FormData();
        formData.append('user_id', $("#newConfReqForm").find("[name='user_id']").val());
        formData.append('conferenceid', $("#newConfReqForm").find("[name='conferenceid']").val());
        formData.append('firstname', $("#newConfReqForm").find("[name='firstname']").val());
        formData.append('phone', $("#newConfReqForm").find("[name='phone']").val());
        formData.append('email', $("#newConfReqForm").find("[name='email']").val());
        formData.append('confname', $("#newConfReqForm").find("[name='confname']").val());
        formData.append('conf_frequency', $("#newConfReqForm").find("[name='conf_frequency']").val());
        formData.append('conf_cost', $("#newConfReqForm").find("[name='conf_cost']").val());
        formData.append('conf_location', $("#newConfReqForm").find("[name='conf_location']").val());
        formData.append('confstart', $("#newConfReqForm").find("[name='conf_start']").val());
        formData.append('travelstart', $("#newConfReqForm").find("[name='travel_start']").val());
        formData.append('lastname', $("#newConfReqForm").find("[name='lastname']").val());
        formData.append('another_phone', $("#newConfReqForm").find("[name='another_phone']").val());
        formData.append('another_email', $("#newConfReqForm").find("[name='another_email']").val());
        formData.append('confurl', $("#newConfReqForm").find("[name='confurl']").val());
        formData.append('mngemail', $("#newConfReqForm").find("[name='mngemail']").val());
        formData.append('travel_cost', $("#newConfReqForm").find("[name='travel_cost']").val());
        formData.append('conf_city', $("#newConfReqForm").find("[name='conf_city']").val());
        formData.append('confend', $("#newConfReqForm").find("[name='conf_end']").val());
        formData.append('travelend', $("#newConfReqForm").find("[name='travel_end']").val());
        formData.append('attendees_travelling', $("#newConfReqFormTwo").find("[name='attendees_travelling']").val());
        formData.append('description', $("#newConfReqFormTwo").find("[name='description']").val());
        formData.append('role', $("input[name='role']:checked").val());
        formData.append('sponsoring_cost', $("#newConfReqFormTwo").find("[name='sponsoring_cost']").val());
        formData.append('benefits', $("#newConfReqFormTwo").find("[name='benefits']").val());
        formData.append('deliverables', $("#newConfReqFormTwo").find("[name='deliverables']").val());
        formData.append('business', $("#newConfReqFormThree").find("[name='business']").val());
        formData.append('industry', $("input[name='industry']:checked").val());
        formData.append('audience', $("#newConfReqFormThree").find("[name='audience']").val());
        $.ajax({
            type: 'POST',
            url: '{{url("/apply")}}',
            dataType: 'JSON',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('#model_loadingmessage').hide();
                $('body').addClass("loading");
                $('.new-conference-form').hide();
                $('.new-conference-form-two').hide();
                $('.new-conference-form-three').hide();
                $('.thank-you').show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    },
});
$('#phone').keyup(function(){
    $(this).val($(this).val().replace(/(\d{3})\ ?(\d{3})\ ?(\d{4})/,'($1)$2-$3'));
    var phone = $(this).val();
    if(phone.length > 13){
        phone = phone.slice(0, 13);
        $(this).val(phone);
    }
});

$('#another_phone').keyup(function(){
    $(this).val($(this).val().replace(/(\d{3})\ ?(\d{3})\ ?(\d{4})/,'($1)$2-$3'));
    var phone = $(this).val();
    if(phone.length > 13){
        phone = phone.slice(0, 13);
        $(this).val(phone);
    }
});

$('.prefilled').children().next().find('input').css({
   'border-color' : 'transparent',
   'box-shadow' : 'none'
});

var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    
var checkin = $('#conf_start').datepicker({
    format: 'mm/dd/yyyy',
    onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
    } 
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate());
    checkout.setValue(newDate);
    }
    checkin.hide();
    $('#conf_start-error').hide();
    $('#conf_end')[0].focus();
}).data('datepicker');
var checkout = $('#conf_end').datepicker({
    format: 'mm/dd/yyyy',
    onRender: function(date) {
    return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    checkout.hide();
    $('#conf_end-error').hide();
}).data('datepicker');

var nowTemp1 = new Date();
var now1 = new Date(nowTemp1.getFullYear(), nowTemp1.getMonth(), nowTemp1.getDate(), 0, 0, 0, 0);
    
var checkin1 = $('#travel_start').datepicker({
    format: 'mm/dd/yyyy',
    onRender: function(date) {
    return date.valueOf() < now1.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout1.date.valueOf()) {
    var newDate1 = new Date(ev.date)
    newDate1.setDate(newDate1.getDate() + 1);
    checkout1.setValue(newDate1);
    }
    checkin1.hide();
    $('#travel_start-error').hide();
    $('#travel_end')[0].focus();
}).data('datepicker');
var checkout1 = $('#travel_end').datepicker({
    format: 'mm/dd/yyyy',
    onRender: function(date) {
    return date.valueOf() < checkin1.date.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    checkout1.hide();
    $('#travel_end-error').hide();
}).data('datepicker');

</script>
<style type="text/css">
.bs-example {
    font-family: sans-serif;
    position: relative;
    margin: 100px;
}

.typeahead:focus {
    border: 2px solid #0097CF;
}

.tt-hint {
    color: #999999;
}
.tt-menu {
    background-color: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 3px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    padding: 8px 0;
}
.tt-suggestion {
    font-size: 16px;  /* Set suggestion dropdown font size */
    padding: 3px 12px;
    color: #000000;
}
.tt-suggestion:hover {
    cursor: pointer;
    background-color: #0097CF;
    color: #FFFFFF;
}
.tt-suggestion p {
    margin: 0;
}
.ui-datepicker-trigger {
    position: relative;
    float: right;
    margin-top: 8px;
    margin-right: -16px;
}

</style>

@endsection
