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
                    <div class="panel-heading" data-target="#collapseOne"><b>Created New Conference</b></div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle">
                            <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="conference">
                                <thead>
                                    <tr>
                                        <td> <b>Created User</b> </td>
                                        <td> <b>Conference Name</b> </td>
                                        <td> <b>Conference Website</b> </td>
                                        <td> <b>Conference Frequency</b> </td>
                                        <td> <b>Actions</b> </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-target="#collapseTwo"><b>Applied to Existing Conference</b></div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body accordion-toggle">
                            <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="apply">
                                <thead>
                                    <tr>
                                        <td> <b>Requested User</b> </td>
                                        <td> <b>Conference Name</b> </td>
                                        <td> <b>Start Date</b> </td>
                                        <td> <b>End Date</b> </td>
                                        <td> <b>Actions</b> </td>
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


<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="relativeSearch">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Relative Conferences</b></h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="conid" id="conid" value="">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Conference Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="relconfhtml">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" id="reject" class="btn btn-danger approve-reject"> Reject </a>
        <a href="javascript:void(0)" id="approve" class="btn btn-success approve-reject"> Approve </a>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="rejectAppliedForm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Reject the Request</h4>
        </div>
        {!! Form::open(array('url' => 'reject_applied_conference', 'data-toggle' => 'validator')) !!}
        <div class="modal-body">                    
            <div class="form-group">
                <input type="hidden" id="id" name="id" value="id"/>
                <label class="control-label" for="reason">Enter the reason to reject<span> *</span></label>
                <textarea id="reason" data-error="Please enter the reason to reject" rows="3" class="form-control" name="reason" required></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Reject',['class' => 'btn btn-success pull-right']) !!}
            {!! Form::close() !!}  
        </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="rejectForm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Reject the Request</h4>
        </div>
        {!! Form::open(array('url' => 'reject_new_conference', 'data-toggle' => 'validator')) !!}
        <div class="modal-body">                    
            <div class="form-group">
                <input type="hidden" id="id" name="id" value="id"/>
                <label class="control-label" for="reason">Enter the reason to reject<span> *</span></label>
                <textarea id="reason" data-error="Please enter the reason to reject" rows="3" class="form-control" name="reason" required></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Reject',['class' => 'btn btn-danger pull-right']) !!}
            {!! Form::close() !!}  
        </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$(document).on("click", ".reject_new", function () {
     var id = $(this).data('id');
     $(".modal-body #id").val( id );
});
</script>
<script type="text/javascript">
$(document).on("click", ".reject_applied", function () {
     var id = $(this).data('id');
     $(".modal-body #id").val( id );
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#conference').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('adminconference.getconference') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'firstname', name: 'firstname'},
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
            {data: 'frequency', name: 'frequency'},
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="javascript:void(0)" id="'+oData.id+'" name="'+oData.conferencename+'" class="btn btn-success relativeSearch">Approve</a> ' + '<a href="#rejectForm" data-id="'+oData.id+'" data-toggle="modal" class="btn btn-danger reject_new">Reject</a>');
                },
            },
        ]
    });
});

$(document).ready(function() {
    oTable = $('#apply').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('adminapply.getapply') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'firstname', name: 'firstname'},
            {data: 'confname', name: 'confname' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.conferenceid+'">'+oData.confname+'</a>');
                }
            },
            {data: 'confstart', name: 'confstart'},
            {data: 'confend', name: 'confend'},
            {data: 'confname', name: 'confname' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a onclick="return confirm(\'Are you sure you want to approve this request?\')" href="{{url('/approveapplied')}}/'+oData.id+'" class="btn btn-success">Approve</a> ' + '<a href="#rejectAppliedForm" data-id="'+oData.id+'" data-toggle="modal" class="btn btn-danger reject_applied">Reject</a>');
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
