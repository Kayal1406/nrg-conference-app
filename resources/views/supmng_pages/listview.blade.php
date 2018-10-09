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
            <div class="panel panel-default">
                <div class="panel-heading"><b>Approved Conference List</b></div>
                <div class="panel-body">
                        <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="supmnglist">
                            <thead>
                                <tr>
                                    <td> <b>Conference Name</b> </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#supmnglist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('listviews.getlist') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.id+'">'+oData.conferencename+'</a>');
                }
            },
        ]
    });
});
</script>
@endsection