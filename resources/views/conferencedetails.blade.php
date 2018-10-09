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
                    <div class="panel-heading action-btns" data-parent="#accordion" data-target="#collapseOne"> 
                        <div class="pull-left-panel"><b>Conference Details</b></div>
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
                    <div class="panel-heading" data-parent="#accordion" data-target="#collapseTwo">
                        <b>{{$modal_conf->conference_dates}}</b>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle">
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>NRG Attendees</b>
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
                                    <b>Conference Notes</b>
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
                        <b><a href="javascript:void(0)">{{ $conference->conference_dates }}</a></b>
                    </div>
                    <div id="{{$conference->id}}" class="panel-collapse collapse">
                        <div class="panel-body accordion-toggle">
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>NRG Attendees</b>
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
                                <div class="panel-heading" data-parent="#accordion" data-target="#collapseTwo">
                                    <b>Conference Notes</b>
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
@endsection
