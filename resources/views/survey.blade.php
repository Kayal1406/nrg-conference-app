@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" data-dismiss="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ Session::get('success') }}
        </div>
    @elseif(Session::has('danger'))
        <div class="alert alert-danger" data-dismiss="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ Session::get('danger') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <span class="history-table">
                <ul class="nav nav-pills" id="myTab">
                    <li><a data-target="#active_conference" data-toggle="tab">My Active Conferences</a></li>
                    <li><a data-target="#requests" class="" data-toggle="tab">My Requests</a></li>
                    <li class="active"><a data-target="#history" class="" data-toggle="tab">My Conference History</a></li>
                </ul>
            </span>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="active_conference">
                            @forelse($active_conferences as $active)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="conference-name-dashboard" href="{{url('/leads')}}/{{$active->conferenceid}}"><b>{{$active->conferencename}}</b></a>
                                    <span class="dates-conference-name"><b>{{$active->conference_dates}}</b></span>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-9">
                                        <div><b>Conference Description:</b></div>
                                        <p align="justify">{{$active->description}}</p>
                                    </div>    
                                    <div class="col-md-3">
                                        @if($active->conferenceurl)
                                        <div><b>Conference Website:</b></div>
                                        <div> <a href="{{$active->conferenceurl}}" target="_blank">{{$active->conferenceurl}}</a> </div>
                                        @endif
                                        <div class="buttons-margin">
                                            <a href="#leadsForm" data-id="{{$active->conferenceid}}" data-toggle="modal" class="leads btn btn-info">Add Leads</a>
                                            <a href="#notesForm" data-id="{{$active->conferenceid}}" data-toggle="modal" class="notes btn btn-info">Add Notes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            No Active Conferences
                            @endforelse
                        </div>
                        <div class="tab-pane" id="requests">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne"><b>Created New Conference</b></div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body accordion-toggle">
                                            <div class="table-responsive">
                                            <table cellspacing="0" width="100%" class="table table-bordered table-striped display responsive nowrap" id="tab-conference">
                                                <thead>
                                                    <tr>
                                                        <td> <b>Conference Name</b> </td>
                                                        <td> <b>Conference URL</b> </td>
                                                        <td> <b>Approval Status</b> </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo"><b>Applied to Existing Conference</b></div>
                                    <div id="collapseTwo" class="panel-collapse collapse in">
                                        <div class="panel-body accordion-toggle">
                                            <div class="table-responsive">
                                                <table cellspacing="0" width="100%" class="table table-bordered table-striped display responsive nowrap" id="apply">
                                                    <thead>
                                                        <tr>
                                                            <td> <b>Conference Name</b> </td>
                                                            <td> <b>Admin Approval Status</b> </td>
                                                            <td> <b>Admin Remarks</b> </td>
                                                            <td> <b>Manager Approval Status</b> </td>
                                                            <td> <b>Manager Remarks</b> </td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="history">
                            <span class="history-table">
                                <div class="table-responsive">
                                    <table cellspacing="0" width="100%" class="table table-bordered table-striped display responsive nowrap" id="tab-history">
                                        <thead>
                                            <tr>
                                                <td> <b>Conference Name</b> </td>
                                                <td> <b>Dates</b> </td>
                                                <td> <b>Results</b> </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-target="#demo" style="cursor:pointer">
                                        <h4 class="panel-title text-center">
                                            <b>{{$lastyear}} Conferences</b>
                                        </h4>
                                    </div>
                                    <div id="demo" class="panel-collapse collapse">
                                        <div class="table-responsive">
                                            <table cellspacing="0" width="100%" class="table table-bordered table-striped display responsive nowrap" id="tab-lastyear">
                                                <thead>
                                                    <tr>
                                                        <td> <b>Conference Name</b> </td>
                                                        <td> <b>Dates</b> </td>
                                                        <td> <b>Results</b> </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-target="#last" style="cursor:pointer">
                                        <h4 class="panel-title text-center">
                                            <b>{{$pastlastyear}} Conferences</b>
                                        </h4>
                                    </div>
                                    <div id="last" class="panel-collapse collapse">
                                        <div class="table-responsive">
                                            <table cellspacing="0" width="100%" class="table table-bordered table-striped display responsive nowrap" id="tab-pastlastyear">
                                                <thead>
                                                    <tr>
                                                        <td> <b>Conference Name</b> </td>
                                                        <td> <b>Dates</b> </td>
                                                        <td> <b>Results</b> </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <span class="history-form">
                                <img align="middle" src="{{ asset('assets/images/stage1.png')}}" class="image-staging"/>
                                <form name="surveyForm" id="surveyForm" name="surveyForm" method="post" class="form" novalidate="novalidate">
                                    <div class="row first-page">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="form-text">Please fill out the request below. Read-only fields can be edited by clicking on them</div>
                                            <div class="form-group">
                                                <label class="control-label"><b>What was the primary reason for attending? Please select an option below:</b></label>
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default form-btn survey-form-radio">
                                                        <input type="radio" name="reason" id="brand_awareness" value="Brand Awareness" required/>Brand Awareness
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-form-radio">
                                                        <input type="radio" name="reason" id="new_market" value="Entering a new market" required/>Entering a new market
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-form-radio">
                                                        <input type="radio" name="reason" id="lead_generation" value="Lead generation" required/>Lead generation
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-form-radio">
                                                        <input type="radio" name="reason" id="intelligence" value="Market/Competitive intelligence" required/>Market/Competitive intelligence
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-form-radio">
                                                        <input type="radio" name="reason" id="leadership" value="Thought Leadership" required>Thought Leadership
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group error_hand_reason"></div>
                                            <div class="form-group">
                                                <label class="control-label" for="competitors"><b>What did you learn from the conference about the market and competitors?</b></label>
                                                <div class="survey-form-fields">
                                                    <textarea id="competitors" data-error="Please enter your learnings" class="form-control" name="competitors" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                                        
                                            <div class="form-group survey-go-back pull-right">
                                                <a href="javascript:void(0);" class="btn survey-btn go-back btn-default btn-md">Go Back</a>
                                                <button class="btn submit survey-btn btn-info btn-md" type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </span>

                            <span class="history-form-two">
                                <img align="middle" src="{{ asset('assets/images/stage2.png')}}" class="image-staging"/>
                                <form name="surveyFormTwo" id="surveyFormTwo" method="post" class="form-horizontal" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="form-text-new">Please fill out the request below. Read-only fields can be edited by clicking on them</div>
                                            <div class="form-group prefilled">
                                                <div class="form-group"><b>Total Expenses</b></div>
                                                <div class="col-md-4">
                                                    <label for="costs" class="control-label">Conference Cost</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" class="rmv-box" maxlength="10" id="costs" name="conference_costs" value="{{$conference_cost}}"/>
                                                    </div> 
                                                    <div class="error_hand_conference_costs"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label" for="expenses">Travel and Expenses</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" class="rmv-travel" name="conference_expenses" id="expenses" value="{{$travel_cost}}"/>
                                                    </div> 
                                                    <div class="error_hand_conference_expenses"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="scheduled"><b>How many meetings did you schedule with {{$conferencename}} attendees?</b></label>
                                                <div class="survey-form-fields">
                                                    <input id="scheduled" maxlength="10" data-error="Please enter no of meetings scheduled" class="form-control col-md-4" name="scheduled" required/> 
                                                    <p class="text-near-box col-md-4">Meetings scheduled</p>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="attended"><b>How many meetings did you attend with {{$conferencename}} attendees?</b></label>
                                                <div class="survey-form-fields">
                                                    <input id="attended" maxlength="10" data-error="Please enter no of meetings attended" class="form-control col-md-4" name="attended" required/> 
                                                    <p class="text-near-box col-md-4">Meetings attended</p>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><b>Will you be contacting targeted attendees personally? If no, please elaborate:</b></label>
                                                <div class="btn-group radio_personal_contacts" data-toggle="buttons">
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="personal_contacts" value="Yes" required/>Yes
                                                    </label>
                                                    <br/>
                                                    <label class="btn btn-default form-btn survey-forms-radio">
                                                        <input type="radio" name="personal_contacts" value="No" required/>No
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group error_hand_personal_contacts"></div>     
                                            <div class="form-group elaborate-onclick">
                                                <div class="survey-form-fields">
                                                    <textarea id="elab-no" data-error="Please enter your reason" placeholder="Please elaborate" class="form-control" name="elaborateno" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="additional_plans"><b>Please describe additional plans for follow-up with targeted attendees:</b></label>
                                                <div class="survey-form-fields">
                                                    <textarea id="additional_plans" data-error="Please enter your additional plans" class="form-control" name="additional_plans" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                                        
                                            <div class="form-group survey-go-back pull-right">
                                                <a href="javascript:void(0);" class="btn survey-btn btn-default go-back-one btn-md">Go Back</a>
                                                <button class="btn submit survey-btn btn-info btn-md" type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </span>

                            <span class="history-form-three">
                                <img align="middle" src="{{ asset('assets/images/stage3.png')}}" class="image-staging"/>
                                <form name="surveyFormThree" id="surveyFormThree" enctype="multipart/form-data" method="post" class="form-horizontal" novalidate="novalidate" files="true">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group">Please fill out the request below. Read-only fields can be edited by clicking on them</div>
                                            <div class="form-group">
                                                <div><label class="control-label"><b>How likely are you to recommend attending {{$conferencename}} in the future?</b></label></div>
                                                <div class="btn-group survey-form-fields" data-toggle="buttons">
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="1" required/>1
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="2" required/>2
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="3" required/>3
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="4" required/>4
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="5" required>5
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="6" required>6
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="7" required>7
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="8" required>8
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="9" required>9
                                                    </label>
                                                    <label class="btn btn-default form-btn">
                                                        <input type="radio" name="recommend" value="10" required>10
                                                    </label>
                                                    <div class="likely">
                                                        <span class="pull-left">Not at all likely</span>
                                                        <span class="pull-right">Extremely likely</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group error_hand_recommend"></div>

                                            <div class="form-group">
                                                <label class="control-label" for="attendees"><b>How many people were in attendence at {{$conferencename}}?</b></label>
                                                <div class="survey-form-fields">
                                                    <input id="attendees" maxlength="10" data-error="Please enter no of attendees" class="form-control col-md-4" name="attendees" required/> 
                                                    <p class="text-near-box col-md-8">Total number of attendees</p>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="companies"><b>How many companies were in attendance at {{$conferencename}}?</b></label>
                                                <div class="survey-form-fields">
                                                    <input id="companies" maxlength="10" data-error="Please enter no of companies" class="form-control col-md-4" name="companies"/> 
                                                    <p class="text-near-box col-md-8">Total number of companies in attendance</p>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="companies"><b>Please select below to manage Leads and Attendees:</b></label>
                                                <div class="attendies-size survey-form-fields">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" href="#collapse">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                                    Attendees (view/add)
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <p>Upload a file below:</p>
                                                                    <!--<input type="file" id="attendees_list_feedback" name="attendees_list_feedback"/>-->
                                                                    <input type="file" name="attendees_list_feedback" id="attendees_list_feedback" class="file">
                                                                    <div class="file-upload-block">
                                                                        <span class="browse"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Browse files</span>
                                                                        <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>Download files below:</p>
                                                                    <div><a href="{{ url('attendeelistdownload', $conference->id) }}">{{$conferencename}}-Attendee-List</a></div>
                                                                    <div><a href="{{asset('uploads/Upload_Attendees_Format.xlsx')}}">Upload-Attendee-List-Template.xlsx</a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="conferenceid" value="{{$conference->id}}"/>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" href="#collapsee">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                                    Leads (view/add)
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapsee" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <p>Upload a file below:</p>
                                                                    <input type="file" name="leads_list_feedback" id="leads_list_feedback" class="file">
                                                                    <div class="file-upload-block">
                                                                        <span class="browse"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Browse files</span>
                                                                        <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>Download files below:</p>
                                                                    <div><a href="{{ url('leadslistdownload', $conference->id) }}">{{$conferencename}}-Leads-List</a> </div>
                                                                    <div><a href="{{asset('uploads/Upload_Leads_Format.xlsx')}}">Upload-Leads-List-Template.xlsx</a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" href="#collapses">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                                    Other related documents (view/add)
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapses" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <p>Upload a file below:</p>
                                                                    <input type="file" name="documents_feedback" id="documents_feedback" class="file">
                                                                    <!--<div class="file-upload-block">
                                                                        <span class="browse"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Browse files</span>
                                                                        <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                    </div>-->
                                                                    <div class="file-upload-btn">
                                                                        <span class="browse"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Add a File</span>
                                                                    </div>
                                                                    <div class="help-block with-errors"></div> 
                                                                    <div class="file-upload-label">
                                                                        <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>Download files below:</p>
                                                                    @if(!empty($documents))
                                                                    @foreach($documents as $doc)
                                                                        <li class="list-style"><a href="{{ asset('uploads/'.$conference->id.'/'.$doc) }}" target="_blank"><i class="glyphicon glyphicon-download-alt"></i>  {{$doc}}</a></li>
                                                                    @endforeach
                                                                    @else
                                                                    No Documents Available
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                <p>Thank you for filling out the survey!</p>
                                <div class="text-center-button"><a href="{{route('user')}}" class="btn back survey-btn btn-info btn-md">Back to My Dashboard</a></div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="another_lead" value="{{ Session::get('another_lead')}}"/>
<!-- Modal -->
<div id="leadsForm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><strong>Add a Lead</strong></h4>
        </div>
        {!! Form::open(array('url' => 'saveleads', 'name' => 'leadsform','data-toggle' => 'validator')) !!}
        <div class="modal-body">
        @if(Session::has('wrong'))
        <div class="alert alert-danger" data-dismiss="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('wrong') }}
        </div>
        @endif
        <p class="control-label required-label col-md-12"><span> *</span> <strong>Required fields</strong></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">  
                                <input type="hidden" id="conferenceid" name="conferenceid" value="" required/>
                                <input type="hidden" name="user_id" value="{{Cookie::get('uid')}}" required/>
                                <label class="control-label" for="firstname">First Name<span> *</span></label>
                                <input type="text" maxlength="25" id="firstname" data-error="Please enter the first name" class="form-control" name="firstname" required/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">  
                            <label class="control-label" for="lastname">Last Name<span> *</span></label>
                            <input type="text" maxlength="25" id="lastname" data-error="Please enter the last name" class="form-control" name="lastname" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="company">Company Name<span> *</span></label>
                            <input type="text" id="company" data-error="Please enter the company name" class="form-control" name="company" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="email">Email Address</label>
                            <input type="text" data-error="Please enter email address" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-pattern-error="Please enter valid email address" class="form-control" id="email" name="email"/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="phone">Phone Number</label>
                            <input type="text" pattern="^([0-9()-]+$" data-pattern-error="Please enter the correct phone number" id="phone" class="form-control" name="phone"/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="potential">Lead Potential MW</label>
                            <input type="text" class="form-control" id="potential" name="potential"/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="sendleads">Send Lead To</label>
                            <input type="text" id="sendleads" class="form-control sendleads type tt-query" name="sendleads"/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 notes-margin">
                    <div class="form-group">
                        <label class="control-label" for="notes">Notes</label>
                        <textarea id="notes" class="form-control notes-text" name="notes"></textarea>
                    </div>
                </div>
                <div class="col-md-12 another-lead-div">
                    <img src="{{ asset('assets/images/plus.png') }}" alt="plus"/>
                    {!! Form::submit('Add another lead',['name' => 'another_lead', 'class' => 'lead_button']) !!}
                </div>
            </div>
        </div>
        <div class="modal-footer leads-form">
            <button type="button" class="btn btn-md btn-pop btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Submit',['class' => 'btn btn-md btn-pop btn-info pull-right', 'name' => 'submit_lead']) !!}
            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="notesForm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Add Notes</b></h4>
        </div>
        {!! Form::open(array('url' => 'addnotes', 'data-toggle' => 'validator')) !!}
        <div class="modal-body notes-form">      
            <input type="hidden" id="conferenceid" name="conferenceid" value=""/>        
            <input type="hidden" name="useremail" value="{{Cookie::get('uemail')}}"/>
            <div class="form-group">
                <label class="control-label" for="notes">Enter Your Notes<span> *</span></label>
                <textarea id="notes" data-error="Please enter the notes" rows="5" class="form-control" name="notes" required></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer leads-form">
            <button type="button" class="btn btn-md btn-pop btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Submit',['class' => 'btn btn-info btn-pop btn-md pull-right']) !!}
            {!! Form::close() !!}  
        </div>
    </div>
  </div>
</div>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript">
$('.rmv-box').click(function(){
    $(this).css({
        'border-color' : '',
        'box-shadow' : ''
    });
    $(this).prev().parent().prev().parent().prev().parent().removeClass('prefilled');
});

$('.rmv-travel').click(function(){
    $(this).css({
        'border-color' : '',
        'box-shadow' : ''
    });
    $(this).prev().parent().prev().parent().prev().prev().parent().removeClass('prefilled');
});

$('.collapse').on('shown.bs.collapse', function(){
    $(this).prev().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
    $(this).prev().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});

$('.history-table').hide();
$('.history-form-two').hide();
$('.history-form-three').hide();
$(".elaborate-onclick").hide();
$('.thank-you').hide();

$("input[name='personal_contacts']").change(function(){
    if($(this).val() == "No"){
        $(".elaborate-onclick").show();
    }
    else{
        $(".elaborate-onclick").hide();
    }
});   

$(document).ready(function() {

    $(document).on("click", ".leads", function () {
        var conference_id = $(this).data('id');
        $("#leadsForm #conferenceid").val( conference_id );
    });

    $(document).on("click", ".notes", function () {
        var conference_id = $(this).data('id');
        $(".notes-form #conferenceid").val( conference_id );
    });

    oTable = $('#tab-conference').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax": "{{ route('conference.getconference', Cookie::get('uid')) }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.id+'">'+oData.conferencename+'</a>');
                }
            },
            {data: 'conferenceurl', name: 'conferenceurl' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a target="_blank" href="'+oData.conferenceurl+'">'+oData.conferenceurl+'</a>');
                }
            },
            {data: 'status_sm', name: 'status_sm'},
        ]
    });
});

$(document).ready(function() {
    oTable = $('#apply').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax": "{{ route('apply.getapply', Cookie::get('uid')) }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'confname', name: 'confname' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.conferenceid+'">'+oData.confname+'</a>');
                }
            },
            {data: 'status_sm', name: 'status_sm'},
            {data: 'admin_remarks', name: 'admin_remarks'},
            {data: 'status_m', name: 'status_m'},
            {data: 'manager_remarks', name: 'manager_remarks'},
        ]
    });
});

$(document).ready(function() {
    oTable = $('#tab-history').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax": "{{ route('history.gethistory', Cookie::get('uid')) }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'confname', name: 'confname' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.conferenceid+'">'+oData.confname+'</a>');
                }
            },
            {data: 'conference_dates', name: 'conference_dates'},            
            {
                "render" : function(data, type, row){
                    if(row.results == ""){
                        var url = '{{ route("survey", ":id") }}';
                        url = url.replace(':id', row.conferenceid);
                        return '<a href="'+url+'">Survey</a>';
                    }
                    else{
                        return row.results;
                    }
                }
            }
        ]
    });
});

$(document).ready(function() {
    oTable = $('#tab-lastyear').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax": "{{ route('lastyear.getlastyear', Cookie::get('uid')) }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'confname', name: 'confname' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.conferenceid+'">'+oData.confname+'</a>');
                }
            },
            {data: 'conference_dates', name: 'conference_dates'},
            {
                "render" : function(data, type, row){
                    if(row.results == ""){
                        var url = '{{ route("survey", ":id") }}';
                        url = url.replace(':id', row.conferenceid);
                        return '<a href="'+url+'">Survey</a>';
                    }
                    else{
                        return row.results;
                    }
                }
            }
        ]
    });
});

$(document).ready(function() {
    oTable = $('#tab-pastlastyear').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax": "{{ route('pastlastyear.getpastlastyear', Cookie::get('uid')) }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'confname', name: 'confname' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.conferenceid+'">'+oData.confname+'</a>');
                }
            },
            {data: 'conference_dates', name: 'conference_dates'},
            {
                "render" : function(data, type, row){
                    if(row.results == ""){
                        var url = '{{ route("survey", ":id") }}';
                        url = url.replace(':id', row.conferenceid);
                        return '<a href="'+url+'">Survey</a>';
                    }
                    else{
                        return row.results;
                    }
                }
            }
        ]
    });
});
$('.go-back').click(function(){
    $('.history-table').show();
    $('.history-form').hide();
    $('.history-form-two').hide();
    $('.history-form-three').hide();
    $(".elaborate-onclick").hide();
    $('.thank-you').hide();
});

$('.go-back-one').click(function(){
    $('.history-table').hide();
    $('.history-form').show();
    $('.history-form-two').hide();
    $('.history-form-three').hide();
    $(".elaborate-onclick").hide();
    $('.thank-you').hide();
});

$('.go-back-two').click(function(){
    $('.history-table').hide();
    $('.history-form').hide();
    $('.history-form-two').show();
    $('.history-form-three').hide();
    $(".elaborate-onclick").hide();
    $('.thank-you').hide();
});

$("input[name='reason']").change(function(){
    $('#reason-error').hide();
});

$("input[name='personal_contacts']").change(function(){
    $('#personal_contacts-error').hide();
});

$("input[name='recommend']").change(function(){
    $('#recommend-error').hide();
});

jQuery.validator.addMethod("costs", function( value, element ) {
    var regex = new RegExp("^[+-]?([0-9]*[.])?[0-9]+$");
    var key = value;
    if (!regex.test(key) && value != '') {
    return false;
    }
    return true;
}, "Please enter numbers only");

$("form[name=surveyForm]").validate({
    errorClass: "my-error-class",
    rules :{
    reason :{
        required:true
    },
    competitors : {
        required: true
    },
    },
    messages : {
    reason :{
        required : "Please select anyone of the reasons"
    },
    competitors :  {
        required: "Please enter your learnings",
    },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "reason" ) {
          error.appendTo('.error_hand_reason');
        }
        else {
          error.insertAfter(element);
        }    
      },
    submitHandler:function(form) {
    $('.history-table').hide();
    $('.history-form').hide();
    $('.history-form-two').show();  
    },
});

$("form[name=surveyFormTwo]").validate({
    errorClass: "my-error-class",
    rules :{
        conference_costs :{
            required:true,
            costs:true
        },
        conference_expenses : {
            required: true,
            costs:true
        },
        scheduled : {
            required: true,
            number : true
        },
        attended : {
            required: true,
            number : true
        },
        personal_contacts : {
            required: true
        },
        elaborateno : {
            required: true
        },
        additional_plans : {
            required: true
        },
    },
    messages : {
        conference_costs :{
            required : "Please enter the costs"
        },
        conference_expenses :  {
            required: "Please enter the costs",
        },
        scheduled :{
            required : "Please enter the meetings scheduled",
            number: "Please enter numeric value only"
        },
        attended :{
            required : "Please enter the meetings attended",
            number: "Please enter numeric value only"
        },
        personal_contacts :{
            required : "Please select anyone of the fields"
        },
        elaborateno :{
            required : "Please enter the reason"
        },
        additional_plans :{
            required : "Please enter the additional plans"
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "personal_contacts" ) {
          error.appendTo('.error_hand_personal_contacts');
        }else if (element.attr("name") == "conference_costs" ) {
          error.appendTo('.error_hand_conference_costs');
        }else if (element.attr("name") == "conference_expenses" ) {
          error.appendTo('.error_hand_conference_expenses');
        }
        else {
          error.insertAfter(element);
        }    
    },
    submitHandler:function(form) {
        $('.history-table').hide();
        $('.history-form').hide();
        $('.history-form-two').hide();
        $('.history-form-three').show(); 
    },
});
$(document).ready(function(){
    if($('input[name="another_lead"]').val() == 1){
        $('#leadsForm').modal('show');
    }
});
$("form[name=surveyFormThree]").validate({
    errorClass: "my-error-class",
    rules :{
        recommend :{
            required:true
        },
        attendees : {
            required: true,
            number : true,
        },
        companies : {
            number : true
        },
        attendees_list_feedback : {
            extension: "xls|xlsx|csv"
        },
        leads_list_feedback : {
            extension: "xls|xlsx|csv"
        },
        documents_feedback : {
            extension: "pdf|doc|docx|xls|xlsx|csv"
        }
    },
    messages : {
        recommend :{
            required : "Please select your recommendation"
        },
        attendees :  {
            required: "Please enter the attendees count",
            number: "Please enter numeric value only"
        },
        companies :  {
            number: "Please enter numeric value only"
        },
        attendees_list_feedback : {
            extension: "Please enter valid file format",
        },
        leads_list_feedback : {
            extension: "Please enter valid file format",
        },
        documents_feedback : {
            extension: "Please enter valid file format",
        }
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "recommend" ) {
          error.appendTo('.error_hand_recommend');
        }
        else {
          error.insertAfter(element);
        }    
    },
    submitHandler:function(form) {
        $('#model_loadingmessage').show();
        $('body').addClass("loading");
      var formData = new FormData();
      var confid = $("#surveyFormThree").find("[name='conferenceid']").val();
      formData.append("attendees_list_feedback", document.getElementById('attendees_list_feedback').files[0]);
      formData.append("leads_list_feedback", document.getElementById('leads_list_feedback').files[0]);
      formData.append("documents_feedback", document.getElementById('documents_feedback').files[0]);
      formData.append('reason', $("input[name='reason']:checked").val());
      formData.append('competitors', $("#surveyForm").find("[name='competitors']").val());
      formData.append('conference_costs', $("#surveyFormTwo").find("[name='conference_costs']").val());
      formData.append('conference_expenses', $("#surveyFormTwo").find("[name='conference_expenses']").val());
      formData.append('scheduled', $("#surveyFormTwo").find("[name='scheduled']").val());
      formData.append('attended', $("#surveyFormTwo").find("[name='attended']").val());
      formData.append('personal_contacts', $("#surveyFormTwo").find("[name='personal_contacts']").val());
      formData.append('elaborateno', $("#surveyFormTwo").find("[name='elaborateno']").val());
      formData.append('additional_plans', $("#surveyFormTwo").find("[name='additional_plans']").val());
      formData.append('recommend', $("input[name='recommend']:checked").val());
      formData.append('attendees', $("#surveyFormThree").find("[name='attendees']").val());
      formData.append('companies', $("#surveyFormThree").find("[name='companies']").val());
      formData.append('conferenceid', $("#surveyFormThree").find("[name='conferenceid']").val());
      $.ajax({
        type: 'POST',
        url: '{{url("/survey")}}/'+confid,
        dataType: 'JSON',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            $('#model_loadingmessage').hide();
            $('body').addClass("loading");
            $('.history-table').hide();
            $('.history-form').hide();
            $('.history-form-two').hide();
            $('.history-form-three').hide();
            $('.thank-you').show();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
        });
    },
});

$('body').on('click','table#tab-user tbody tr', function(){
    var clickedTRObj = $(this);
    $(this).next().find('li').each(function(key,val) {
        $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
    });
});

$('body').on('click','table#tab-conference tbody tr', function(){
    var clickedTRObj = $(this);
    $(this).next().find('li').each(function(key,val) {
        $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
    });
});

$('body').on('click','table#tab-history tbody tr', function(){
    var clickedTRObj = $(this);
    $(this).next().find('li').each(function(key,val) {
        $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
    });
});

$('body').on('click','table#apply tbody tr', function(){
    var clickedTRObj = $(this);
    $(this).next().find('li').each(function(key,val) {
        $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
    });
});

$(document).ready(function(){
    if(!$("#cookieEmail").val())
      $('#myModal').modal('show');
});
$('#phone').keyup(function(){
    $(this).val($(this).val().replace(/(\d{3})\ ?(\d{3})\ ?(\d{4})/,'($1)$2-$3'));
    var phone = $(this).val();
    if(phone.length > 13){
        phone = phone.slice(0, 13);
        $(this).val(phone);
    }
});
</script>
<style type="text/css">
.bs-example {
    font-family: sans-serif;
    position: relative;
    margin: 100px;
}
.type:focus {
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
    font-size: 12px;  /* Set suggestion dropdown font size */
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
.tt-open {
    width: 252px;
    overflow-x: auto;
    position: absolute;
}
</style>

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Enter your email id</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url'=>'registeruser', 'data-toggle'=>'validator']) !!}
        <div class="form-group"> 
          <input type="text" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-error="Please enter your email address" data-pattern-error="Please enter valid email address" id="useremail" name="useremail" class="form-control" required/>
          <div class="help-block with-errors"></div>
        </div>    
      </div>
      <div class="modal-footer">
        {!! Form::submit('Cancel',['data-dismiss' => 'modal', 'class' => 'btn btn-default']) !!}
        {!! Form::submit('Submit',['class' => 'btn btn-info']) !!} 
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
