@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Attended Conference List</b></div>
                <div class="panel-body">
                        <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="attended">
                            <thead>
                                <tr>
                                    <td> <b>Conference Name</b> </td>
                                    <td> <b>Conference Date</b> </td>
                                    <td> <b>Conference URL</b> </td>
                                    <td> <b>Feedback</b> </td>
                                </tr>
                            </thead>
                        </table>
                    <div class="col-xs-6">
                        <a href="{{ url('/') }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#attended').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('attendedconference.getdata') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'confname', name: 'confname'},
            {data: 'confstart', name: 'confstart'},
            {data: 'confurl', name: 'confurl' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="'+oData.confurl+'">'+oData.confurl+'</a>');
                }
            },
            {data: 'conferenceid', name: 'conferenceid' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    /*console.log(oData);*/
                    $(nTd).html('<a class="btn btn-primary" href="/feedback/'+oData.conferenceid+'">Send Feedback</a> ');
                },
            },
        ]
    });
});
</script>
@endsection
