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
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading action-btns" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne"> 
                        <div class="pull-left-panel"><b><a href="javascript:void(0);">Conference Details</a></b></div>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle panelhover">
                            <div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr class="hidden-xs">
                                            <td> <b>Conference Name</b> </td>
                                            <td> {{$conference -> conferencename}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference Name</b></div>
                                                <div class="mt-10">{{$conference -> conferencename}} </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td width="26%"> <b>Conference Description</b> </td>
                                            <td> {{$conference -> description}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference Description</b></div>
                                                <div class="mt-10">{{$conference -> description}}</div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Industries</b> </td>
                                            <td> {{$conference -> industry}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Industries</b></div>
                                                <div class="mt-10">{{$conference -> industry}}</div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Business Relevancy</b> </td>
                                            <td> {{$conference -> business}}</td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Business Relevancy</b></div>
                                                <div class="mt-10">{{$conference -> business}}</div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Conference Frequency</b> </td>
                                            <td> {{$conference -> frequency}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference Frequency</b></div>
                                                <div class="mt-10">{{$conference -> frequency}}</div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Conference Average Attendee Score</b> </td>
                                            <td> @if($att_score_avg) {{$att_score_avg}} @else N/A @endif </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference Average Attendee Score</b></div>
                                                <div class="mt-10"> @if($att_score_avg) {{$att_score_avg}} @else N/A @endif </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Conference Average Sponsorship Score</b> </td>
                                            <td>
                                                @if($overall_score)
                                                    {{$overall_score}} 
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference Average Sponsorship Score</b></div>
                                                <div class="mt-10">
                                                    @if($overall_score)
                                                        {{$overall_score}} 
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Conference Average Sponsorship Cost</b> </td>
                                            <td> 
                                                @if($overall_costs)
                                                    ${{$overall_costs}}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference Average Sponsorship Cost</b></div>
                                                <div class="mt-10">
                                                    @if($overall_costs)
                                                        ${{$overall_costs}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                            
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left-panel" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                        <b><a href="javascript:void(0);">{{$modal_conf->conference_dates}}</a></b>
                        </div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle">
                            <div class="pull-right btn-table">                            
                                <a href="#leadsForm" data-conferenceid="{{$conference->id}}" class="btn btn-md btn-default">Add Leads</a>
                                <a href="#notesForm" data-conferenceid="{{$conference->id}}" class="btn btn-md btn-default">Add Notes</a>
                                @if($is_admin == 1 AND empty($conf_score))
                                <a href="#sponsorship" data-toggle="modal" data-count="{{$count}}" data-id="{{$conference->id}}" class="btn btn-md btn-info btn-hover-change">Sponsorship Survey</a>
                                @endif
                                <input id="cookiemail" type="hidden" value="{{Cookie::get('uemail')}}"/>
                                <input id="admin_email" type="hidden" value="{{$adminEmail}}"/>
                            </div>
                            <div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr class="hidden-xs">
                                            <td> <b>Conference URL</b> </td>
                                            <td> <a target="_blank" href="{{$conference -> conferenceurl}}">{{$conference -> conferenceurl}}</a> </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference URL</b></div>
                                                <div class="mt-10"><a target="_blank" href="{{$conference -> conferenceurl}}">{{$conference -> conferenceurl}}</a></div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Attendee List</b> </td>
                                            <td> <a href="{{ url('attendeelistdownload', $conference->id) }}">Download Attendees</a> </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Attendee List</b></div>
                                                <div class="mt-10"> <a href="{{ url('attendeelistdownload', $conference->id) }}">Download Attendees</a> </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Leads List</b> </td>
                                            <td> <a href="{{ url('leadslistdownload', $conference->id) }}">Download Leads</a></td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Leads List</b></div>
                                                <div class="mt-10"> <a href="{{ url('leadslistdownload', $conference->id) }}">Download Leads</a> </div>
                                            </td>
                                        </tr>

                                        <!--Conference Score-->
                                        @if(!empty($conf_score))
                                        <tr class="hidden-xs">
                                            <td> <b>Sponsorship Cost</b> </td>
                                            <td> {{$conf_score->sponsorship_costs}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Sponsorship Cost</b></div>
                                                <div class="mt-10"> {{$conf_score->sponsorship_costs}} </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Sponsorship Score</b> </td>
                                            <td> {{$conf_score->conference_score}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Sponsorship Score</b></div>
                                                <div class="mt-10"> {{$conf_score->conference_score}} </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Was NRG a Speaker?</b> </td>
                                            <td> {{$conf_score->is_speaker}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Was NRG a Speaker?</b></div>
                                                <div class="mt-10"> {{$conf_score->is_speaker}} </div>
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        <tr class="hidden-xs">
                                            <td> <b>Related Documents</b> </td>
                                            <td> 
                                                @if(!empty($documents))
                                                @foreach($documents as $doc)
                                                    <a href="{{ asset('uploads/'.$conference->id.'/'.$doc) }}" class="list-group-item" target="_blank"><i class="glyphicon glyphicon-download-alt"></i>  {{$doc}}</a></li>
                                                @endforeach
                                                @else
                                                No Documents Available
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Related Documents</b></div>
                                                <div class="mt-10"> 
                                                    @if(!empty($documents))
                                                    @foreach($documents as $doc)
                                                        <a href="{{ asset('uploads/'.$conference->id.'/'.$doc) }}" class="list-group-item" target="_blank"><i class="glyphicon glyphicon-download-alt"></i>  {{$doc}}</a></li>
                                                    @endforeach
                                                    @else
                                                    No Documents Available
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td><b>Upload Related Documents</b> <i data-toggle="tooltip" data-placement="bottom" title="Upload your attendee list, potential lead list or other related documents including agenda, exhibitor prospectus, etc." class="glyphicon glyphicon-exclamation-sign"></i></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            {!! Form::open(['data-toggle' => 'validator', 'files'=>true]) !!}
                                                            <div class="form-group">
                                                                <select id="doctype" name="doctype" class="document_type" data-error="Please select anyone field" required="required">
                                                                    <option value="">Select type of document</option>
                                                                    <option value="attendees_list">Attendees List</option>
                                                                    <option value="potential_leads">Potential Leads</option>
                                                                    <option value="other_docs">Other Documents</option>
                                                                </select>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <input type="hidden" id="conferenceid" name="conferenceid" value="{{$conference->id}}"/>
                                                            <div class="form-group">
                                                                <input type="file" name="import_leads" class="file" required>
                                                                <div class="file-upload-block">
                                                                    <span class="browse"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Browse files</span>
                                                                    <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                </div>
                                                                <div class="help-block with-errors"></div> 
                                                                {!! Form::submit('Upload',['class' => 'btn btn-block btn-primary']) !!}
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="form-group align-center col-md-6">
                                                            <div>Download a file below:</div>
                                                            <div><a href="{{asset('uploads/Upload_Attendees_Format.xlsx')}}">AttendeeListFormat.xlsx</a></div>
                                                            <div><a href="{{asset('uploads/Upload_Leads_Format.xlsx')}}">LeadsListFormat.xlsx</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Upload Related Documents</b> <i data-toggle="tooltip" data-placement="bottom" title="Upload your attendee list, potential lead list or other related documents including agenda, exhibitor prospectus, etc." class="glyphicon glyphicon-exclamation-sign"></i></div>
                                                <div class="mt-10">
                                                    <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            {!! Form::open(['data-toggle' => 'validator', 'files'=>true]) !!}
                                                            <div class="form-group">
                                                                <select id="doctype" name="doctype" class="document_type" data-error="Please select anyone field" required="required">
                                                                    <option value="">Select type of document</option>
                                                                    <option value="attendees_list">Attendees List</option>
                                                                    <option value="potential_leads">Potential Leads</option>
                                                                    <option value="other_docs">Other Documents</option>
                                                                </select>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <input type="hidden" id="conferenceid" name="conferenceid" value="{{$conference->id}}"/>
                                                            <div class="form-group">
                                                                <input type="file" name="import_leads" class="file" required>
                                                                <div class="file-upload-block">
                                                                    <span class="browse"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Browse files</span>
                                                                    <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                </div>
                                                                <div class="help-block with-errors"></div> 
                                                                {!! Form::submit('Upload',['class' => 'btn btn-block btn-primary']) !!}
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="form-group align-center col-md-6">
                                                            <div>Download a file below:</div>
                                                            <div><a href="{{asset('uploads/Upload_Attendees_Format.xlsx')}}">AttendeeListFormat.xlsx</a></div>
                                                            <div><a href="{{asset('uploads/Upload_Leads_Format.xlsx')}}">LeadsListFormat.xlsx</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>                                         
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b> <a href="javascript:void(0);">NRG Attendees</a> </b>
                                </div>
                                <div class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Costs</th>                                                
                                                    <th>Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($attendees as $att)
                                            <tr>
                                                <td>{{$att->firstname}}</td>
                                                <td>${{$att->conf_cost}}</td>
                                                <td>@if($att->survey) {{$att->survey}} @else N/A @endif</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3">No Attendees Available</td>
                                            </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                                    <b> <a href="javascript:void(0);">Conference Notes</a> </b>
                                </div>
                                <div class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="comments-section">
                                            @forelse($notes as $n)
                                            <div class="author-comment">
                                                <div class="author"><b>{{$n->useremail}}</b></div>
                                                <div class="notes">{{$n->notes}}</div>
                                            </div>
                                            @empty
                                            <div>No Notes Available for the Conference</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Similar Conference-->
                @foreach($similar_conference as $conference)
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-target="#{{$conference->id}}">
                        <b><a href="javascript:void(0);">{{$conference->conference_dates}}</a></b>
                    </div>
                    <div id="{{$conference->id}}" class="panel-collapse collapse">
                        <div class="panel-body accordion-toggle">
                            <div class="pull-right">                            
                                @if($is_admin == 1 AND is_null($conference->conference_score))
                                <a href="#sponsorship" data-count="{{$conference->leads_count}}" data-id="{{$conference->id}}" data-toggle="modal" class="btn btn-sm btn-info btn-hover-change">Sponsorship Survey</a>
                                @endif
                            </div>
                            <div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr class="hidden-xs">
                                            <td> <b>Conference URL</b> </td>
                                            <td> <a target="_blank" href="{{$conference -> conferenceurl}}">{{$conference -> conferenceurl}}</a> </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference URL</b></div>
                                                <div class="mt-10"><a target="_blank" href="{{$conference -> conferenceurl}}">{{$conference -> conferenceurl}}</a></div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td width="26%"> <b>Conference Average Attendee Score</b> </td>
                                            <td> @if($conference->sim_att_score_avg) {{$conference->sim_att_score_avg}} @else N/A @endif</td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Conference Average Attendee Score</b></div>
                                                <div class="mt-10"> @if($conference->sim_att_score_avg) {{$conference->sim_att_score_avg}} @else N/A @endif </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Attendee List</b> </td>
                                            <td> <a href="{{ url('attendeelistdownload', $conference->id) }}">Download Attendees</a> </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Attendee List</b></div>
                                                <div class="mt-10"> <a href="{{ url('attendeelistdownload', $conference->id) }}">Download Attendees</a> </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Leads List</b> </td>
                                            <td> <a href="{{ url('leadslistdownload', $conference->id) }}">Download Leads</a></td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Leads List</b></div>
                                                <div class="mt-10"> <a href="{{ url('leadslistdownload', $conference->id) }}">Download Leads</a> </div>
                                            </td>
                                        </tr>

                                        <!--Conference Score-->
                                        @if($conference->conference_score != NULL)
                                        <tr class="hidden-xs">
                                            <td> <b>Sponsorship Cost</b> </td>
                                            <td> {{$conference->sponsorship_costs}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Sponsorship Cost</b></div>
                                                <div class="mt-10"> {{$conference->sponsorship_costs}} </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Sponsorship Score</b> </td>
                                            <td> {{$conference->conference_score}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Sponsorship Score</b></div>
                                                <div class="mt-10"> {{$conference->conference_score}} </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td> <b>Was NRG a Speaker?</b> </td>
                                            <td> {{$conference->is_speaker}} </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Was NRG a Speaker?</b></div>
                                                <div class="mt-10"> {{$conference->is_speaker}} </div>
                                            </td>
                                        </tr>
                                        @endif


                                        <tr class="hidden-xs">
                                            <td> <b>Related Documents</b> </td>
                                            <td> 
                                                @if(!empty($documents))
                                                @foreach($documents as $doc)
                                                    <a href="{{ asset('uploads/'.$conference->id.'/'.$doc) }}" class="list-group-item" target="_blank"><i class="glyphicon glyphicon-download-alt"></i>  {{$doc}}</a></li>
                                                @endforeach
                                                @else
                                                No Documents Available
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Related Documents</b></div>
                                                <div class="mt-10"> 
                                                    @if(!empty($documents))
                                                    @foreach($documents as $doc)
                                                        <a href="{{ asset('uploads/'.$conference->id.'/'.$doc) }}" class="list-group-item" target="_blank"><i class="glyphicon glyphicon-download-alt"></i>  {{$doc}}</a></li>
                                                    @endforeach
                                                    @else
                                                    No Documents Available
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hidden-xs">
                                            <td><b>Upload Related Documents</b> <i data-toggle="tooltip" data-placement="bottom" title="Upload your attendee list, potential lead list or other related documents including agenda, exhibitor prospectus, etc." class="glyphicon glyphicon-exclamation-sign"></i></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            {!! Form::open(['data-toggle' => 'validator', 'files'=>true]) !!}
                                                            <div class="form-group">
                                                                <select id="doctype" name="doctype" class="document_type" data-error="Please select anyone field" required="required">
                                                                    <option value="">Select type of document</option>
                                                                    <option value="attendees_list">Attendees List</option>
                                                                    <option value="potential_leads">Potential Leads</option>
                                                                    <option value="other_docs">Other Documents</option>
                                                                </select>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <input type="hidden" id="conferenceid" name="conferenceid" value="{{$conference->id}}"/>
                                                            <div class="form-group">
                                                                <input type="file" name="import_leads" class="file" required>
                                                                <div class="file-upload-block">
                                                                    <span class="browse"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Browse files</span>
                                                                    <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                </div>
                                                                <div class="help-block with-errors"></div> 
                                                                {!! Form::submit('Upload',['class' => 'btn btn-block btn-primary']) !!}
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="form-group align-center col-md-6">
                                                            <div>Download a file below:</div>
                                                            <div><a href="{{asset('uploads/Upload_Attendees_Format.xlsx')}}">AttendeeListFormat.xlsx</a></div>
                                                            <div><a href="{{asset('uploads/Upload_Leads_Format.xlsx')}}">LeadsListFormat.xlsx</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="visible-xs">
                                            <td>
                                                <div><b>Upload Related Documents</b> <i data-toggle="tooltip" data-placement="bottom" title="Upload your attendee list, potential lead list or other related documents including agenda, exhibitor prospectus, etc." class="glyphicon glyphicon-exclamation-sign"></i></div>
                                                <div class="mt-10">
                                                    <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            {!! Form::open(['data-toggle' => 'validator', 'files'=>true]) !!}
                                                            <div class="form-group">
                                                                <select id="doctype" name="doctype" class="document_type" data-error="Please select anyone field" required="required">
                                                                    <option value="">Select type of document</option>
                                                                    <option value="attendees_list">Attendees List</option>
                                                                    <option value="potential_leads">Potential Leads</option>
                                                                    <option value="other_docs">Other Documents</option>
                                                                </select>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <input type="hidden" id="conferenceid" name="conferenceid" value="{{$conference->id}}"/>
                                                            <div class="form-group">
                                                                <input type="file" name="import_leads" class="file" required>
                                                                <div class="file-upload-block">
                                                                    <span class="browse"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Browse files</span>
                                                                    <span class="filename" id="filename" data-error="Please upload the file"></span>
                                                                </div>
                                                                <div class="help-block with-errors"></div> 
                                                                {!! Form::submit('Upload',['class' => 'btn btn-block btn-primary']) !!}
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="form-group align-center col-md-6">
                                                            <div>Download a file below:</div>
                                                            <div><a href="{{asset('uploads/Upload_Attendees_Format.xlsx')}}">AttendeeListFormat.xlsx</a></div>
                                                            <div><a href="{{asset('uploads/Upload_Leads_Format.xlsx')}}">LeadsListFormat.xlsx</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>                                         
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b> <a href="javascript:void(0);">NRG Attendees</a> </b>
                                </div>
                                <div class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Costs</th>                                                
                                                    <th>Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($conference['sim_attendees'] as $att)
                                                <tr>
                                                    <td>{{$att->firstname}}</td>
                                                    <td>${{$att->conf_cost}}</td>
                                                    <td>{{$att->survey}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">No Attendees Available</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                                    <b> <a href="javascript:void(0);">Conference Notes</a> </b>
                                </div>
                                <div class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="comments-section">
                                            @forelse($notes as $n)
                                            <div class="author-comment">
                                                <div class="author"><b>{{$n->useremail}}</b></div>
                                                <div class="notes">{{$n->notes}}</div>
                                            </div>
                                            @empty
                                            <div>No Notes Available for the Conference</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
 <!--Modal -->
<div id="sponsorship" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span class="modal-title"><b>{{$modal_conf->conferencename}} {{$modal_conf->conference_dates}}</b></span>
            </div>
            {!! Form::open(array('url' => 'sponsorshipsurvey', 'data-toggle' => 'validator')) !!}
            <div class="modal-body">
                <input type="hidden" value="" id="conference_id" name="conference_id"/>
                <input type="hidden" value="@if(Auth::user()){{Auth::user()->id}}@endif" id="user_id" name="user_id"/>
                <div class="form-group">
                    <label class="control-label" for="sponsorship_costs">Cost of Sponsorship<span> *</span></label>
                    <input type="text" pattern="^-?\d*(\.\d+)?$" maxlength="10" data-pattern-error="Please enter numbers only" id="sponsorship_costs" data-error="Please enter the sponsorship costs" class="form-control" name="sponsorship_costs" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label">Was NRG a speaker?<span> *</span></label>  
                    <div class="radio">
                        <label for="yes">
                            <input type="radio" name="is_speaker" id="yes" value="Yes" data-error="Please choose anyone" required/> Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label  for="no">
                            <input type="radio" name="is_speaker" id="no"  value="No" required/> No
                        </label>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="leads">Leads - <label class="leadsCount"></label> in system<span> *</span></label>
                    <select class="form-control" id="leads" name="leads" data-error="Please select anyone of this fields" required="required">
                        <option value="">Please Select</option>
                        <option value="20">Low</option>
                        <option value="40">Medium</option>
                        <option value="60">High</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="booth_traffic">Booth Traffic<span> *</span></label>
                    <select class="form-control" id="booth_traffic" name="booth_traffic" data-error="Please select anyone of this fields" required="required">
                        <option value="">Please Select</option>
                        <option value="20">Low</option>
                        <option value="40">Medium</option>
                        <option value="60">High</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="relevant">Currently Relevant<span> *</span></label>
                    <select class="form-control" id="relevant" name="relevant" data-error="Please select anyone of this fields" required="required">
                        <option value="">Please Select</option>
                        <option value="20">Low</option>
                        <option value="40">Medium</option>
                        <option value="60">High</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="promotional_assets">Promotional Assets<span> *</span></label>
                    <select class="form-control" id="promotional_assets" name="promotional_assets" data-error="Please select anyone of this fields" required="required">
                        <option value="">Please Select</option>
                        <option value="20">Low</option>
                        <option value="40">Medium</option>
                        <option value="60">High</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nrg_social_mentions">NRG Social Mentions<span> *</span></label>
                    <select class="form-control" id="nrg_social_mentions" name="nrg_social_mentions" data-error="Please select anyone of this fields" required="required">
                        <option value="">Please Select</option>
                        <option value="20">Low</option>
                        <option value="40">Medium</option>
                        <option value="60">High</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="conf_social_mentions">Conference Social Mentions<span> *</span></label>
                    <select class="form-control" id="conf_social_mentions" name="conf_social_mentions" data-error="Please select anyone of this fields" required="required">
                        <option value="">Please Select</option>
                        <option value="20">Low</option>
                        <option value="40">Medium</option>
                        <option value="60">High</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="invite_open">Email Invite Open<span> *</span></label>
                    <select class="form-control" id="invite_open" name="invite_open" data-error="Please select anyone of this fields" required="required">
                        <option value="">Please Select</option>
                        <option value="20">Low</option>
                        <option value="40">Medium</option>
                        <option value="60">High</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {!! Form::submit('Submit',['class' => 'btn btn-success pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>      
    </div>
</div>

<!-- Modal -->
<div id="leadsForm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Leads</h4>
        </div>
        {!! Form::open(array('url' => 'saveleads', 'data-toggle' => 'validator')) !!}
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="company">Company Name<span> *</span></label>
                <input type="text" id="company" data-error="Please enter the company name" class="form-control" name="company" required/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">  
                <input type="hidden" id="conferenceid" name="conferenceid" value="{{$conference->id}}" required/>
                @if(Cookie::get('uid'))
                <input type="hidden" name="user_id" value="{{Cookie::get('uid')}}" required/>
                @else
                <input type="hidden" name="user_id" value="0" required/>
                @endif
                <label class="control-label" for="firstname">First Name<span> *</span></label>
                <input type="text" maxlength="25" id="firstname" data-error="Please enter your first name" class="form-control" name="firstname" required/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="lastname">Last Name<span> *</span></label>
                <input type="text" maxlength="25" id="lastname" data-error="Please enter your last name" class="form-control" name="lastname" required/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="email">Email Address</label>
                <input type="text" data-error="Please enter email address" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-pattern-error="Please enter valid email address" class="form-control" id="email" name="email"/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="phone">Phone Number</label>
                <input type="text" maxlength="10" pattern="^(\(?\+?[0-9]*\)?)?[3-9_\- \(\)]*$" data-pattern-error="Please enter correct phone number" id="phone" class="form-control" name="phone"/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="notes">Notes</label>
                <textarea id="notes" class="form-control" name="notes"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Submit',['class' => 'btn btn-success pull-right']) !!}
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
            <h4 class="modal-title">Add Notes</h4>
        </div>
        {!! Form::open(array('url' => 'addnotes', 'data-toggle' => 'validator')) !!}
        <div class="modal-body">      
            <input type="hidden" id="conferenceid" name="conferenceid" value="{{$conference->id}}"/>        
            @if(Cookie::get('uemail'))
            <input type="hidden" name="useremail" value="{{Cookie::get('uemail')}}"/>
            @else
            <input type="hidden" name="useremail" value="{{$admin_email_notes_popup}}"/>
            @endif
            <div class="form-group">
                <label class="control-label" for="notes">Enter Your Notes<span> *</span></label>
                <textarea id="notes" data-error="Please enter the notes" rows="5" class="form-control" name="notes" required></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Submit',['class' => 'btn btn-success pull-right']) !!}
            {!! Form::close() !!}  
        </div>
    </div>
  </div>
</div>
  
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Please Login to Continue</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url'=>'registeruser','id' => 'registerForm', 'data-toggle'=>'validator']) !!}
        <div class="form-group">
          <label for="useremail">Enter your email id</label> 
          <input type="text" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-error="Please enter your email address" data-pattern-error="Please enter valid email address" id="useremail" name="useremail" class="form-control" required/>
          <div class="help-block with-errors"></div>
        </div>    
      </div>
      <div class="modal-footer">
        <input data-dismiss="modal" class="btn btn-default" type="button" value="Cancel"/>
        {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!} 
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    $( '#registerForm' ).on( 'keypress', function( e ) {
        if( e.keyCode === 13 ) {
            e.preventDefault();
            $( this ).trigger( 'submit' );
        }
    });
    $('a[href="#leadsForm"]').on('click', function (ev) {
        ev.preventDefault();
        var conferenceID = $(this).data('conferenceid');
        $(".modal-body #conferenceid").val( conferenceID );
        if ($('input#cookiemail').val() == "" && $('input#admin_email').val() == "") {
            $("#leadsForm").modal("hide");
            $("#myModal").modal("show");
        }
        else
        {
            $("#leadsForm").modal("show");
        }
    });

    $('a[href="#sponsorship"]').on('click', function (ev) {
        ev.preventDefault();
        var conferenceID = $(this).data('id');
        $(".modal-body #conference_id").val( conferenceID );
        var leadsCount = $(this).data('count');
        $(".modal-body .leadsCount").text( leadsCount );
    });

    $('a[href="#notesForm"]').on('click', function (ev) {
        ev.preventDefault();
        var conferenceID = $(this).data('conferenceid');
        $(".modal-body #conferenceid").val( conferenceID );
        if ($('input#cookiemail').val() == "" && $('input#admin_email').val() == "") {
            $("#notesForm").modal("hide");
            $("#myModal").modal("show");
        }
        else
        {
            $("#notesForm").modal("show");
        }
    });

    $('.document_type').on('click', function(ev){
        ev.preventDefault();
        if ($('input#cookiemail').val() == "" && $('input#admin_email').val() == "") {
            $("#myModal").modal("show");
        }
    });

    $('.panel-heading .btn').click(function (e) {
        e.stopPropagation();
    });
</script>
@endsection
