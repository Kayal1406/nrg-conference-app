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
            <ul class="nav nav-pills" id="myTab">
                <li class="active "><a data-target="#active_conference" data-toggle="tab">My Active Conferences</a></li>
                <li><a data-target="#requests" class="" data-toggle="tab">My Requests</a></li>
                <li><a data-target="#history" class="" data-toggle="tab">My Conference History</a></li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="active_conference">
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
                                    <div class="panel-heading" data-target="#collapseTwo"><b>Requested Conferences</b></div>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-target="#collapseOne"><b>New Conference Requests</b></div>
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
                            </div>
                        </div>
                        <div class="tab-pane" id="history">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-parent="#accordion" data-target="#collapseThree"><b>2017 Conferences</b></div>
                                    <div id="collapseThree" class="panel-collapse collapse in">
                                        <div class="panel-body accordion-toggle">
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
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-target="#demo" style="cursor:pointer">
                                        <h4 class="panel-title">
                                            <b><a href="javascript:void(0);">{{$lastyear}} Conferences</a></b>
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
                                        <h4 class="panel-title">
                                            <b><a href="javascript:void(0);">{{$pastlastyear}} Conferences</a></b>
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
                            <!--</div>-->
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
                            <input type="text" id="phone" pattern="^([0-9()-]+$" data-pattern-error="Please enter the correct phone number" class="form-control" name="phone"/>
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
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-pop btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Submit',['class' => 'btn btn-info btn-pop btn-md pull-right']) !!}
            {!! Form::close() !!}  
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).on("click", ".leads", function () {
    var conference_id = $(this).data('id');
    $("#leadsForm #conferenceid").val( conference_id );
});

$(document).on("click", ".notes", function () {
    var conference_id = $(this).data('id');
    $(".notes-form #conferenceid").val( conference_id );
});
$(document).ready(function() {
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
                }, 
            },
            {data: 'conferenceurl', name: 'conferenceurl' , 
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a target="_blank" href="'+oData.conferenceurl+'">'+oData.conferenceurl+'</a>');
                }, 
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
$(document).ready(function(){
    if($('input[name="another_lead"]').val() == 1){
        $('#leadsForm').modal('show');
    }
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
@endsection
