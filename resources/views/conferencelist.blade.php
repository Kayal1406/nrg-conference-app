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
                    <div class="panel-heading" data-target="#collapseOne"><b>{{$currentyear}} Conference List</b></div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle">
                            <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="currentConferenceList">
                                <thead>
                                    <tr>
                                        <td> <b>Conference Name</b> </td>
                                        <td> <b>Dates</b> </td>
                                        <td> <b>Average Attendee Score</b> </td>
                                        <td> <b>Attendees</b> </td>
                                        <td> <b>Leads</b> </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-target="#collapseTwo"><b>{{$lastyear}} Conference List</b></div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle">
                            <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="lastYearConferenceList">
                                <thead>
                                    <tr>
                                        <td> <b>Conference Name</b> </td>
                                        <td> <b>Dates</b> </td>
                                        <td> <b>Average Attendee Score</b> </td>
                                        <td> <b>Attendees</b> </td>
                                        <td> <b>Leads</b> </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-target="#collapseThree"><b>{{$pastyear}} Conference List</b></div>
                    <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle">
                            <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="pastYearConferenceList">
                                <thead>
                                    <tr>
                                        <td> <b>Conference Name</b> </td>
                                        <td> <b>Dates</b> </td>
                                        <td> <b>Average Attendee Score</b> </td>
                                        <td> <b>Attendees</b> </td>
                                        <td> <b>Leads</b> </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#currentConferenceList').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('current.conferencelist') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.id+'">'+oData.conferencename+'</a>');
                }
            },
            {data: 'conference_dates', name: 'conference_dates'},
            {data: 'avg_attendee_score', name: 'avg_attendee_score'},
            {data: 'id', name: 'id' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/attendeelistdownload')}}/'+oData.id+'">Download Attendee List</a>');
                },
            },
            {data: 'id', name: 'id' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leadslistdownload')}}/'+oData.id+'">Download Leads List</a>');
                },
            },
        ]
    });
});

$(document).ready(function() {
    oTable = $('#lastYearConferenceList').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('lastyear.conferencelist') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.id+'">'+oData.conferencename+'</a>');
                }
            },
            {data: 'conference_dates', name: 'conference_dates'},
            {data: 'avg_attendee_score', name: 'avg_attendee_score'},
            {data: 'id', name: 'id' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/attendeelistdownload')}}/'+oData.id+'">Download Attendee List</a>');
                },
            },
            {data: 'id', name: 'id' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leadslistdownload')}}/'+oData.id+'">Download Leads List</a>');
                },
            },
        ]
    });
});

$(document).ready(function() {
    oTable = $('#pastYearConferenceList').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('pastyear.conferencelist') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.id+'">'+oData.conferencename+'</a>');
                }
            },
            {data: 'conference_dates', name: 'conference_dates'},
            {data: 'avg_attendee_score', name: 'avg_attendee_score'},
            {data: 'id', name: 'id' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/attendeelistdownload')}}/'+oData.id+'">Download Attendee List</a>');
                },
            },
            {data: 'id', name: 'id' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leadslistdownload')}}/'+oData.id+'">Download Leads List</a>');
                },
            },
        ]
    });
});
$('body').on('click','table tbody tr', function(){
    var clickedTRObj = $(this);
    $(this).next().find('li').each(function(key,val) {
        $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+(key+1)+')').html());
    });
});
</script>
@endsection
