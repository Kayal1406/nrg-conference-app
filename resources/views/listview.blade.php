@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Request a Conference</b></div>
                <div class="panel-body">
                    <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="list">
                        <thead>
                            <tr>
                                <td> <b>Conferences Available</b> </td>
                                <td> <b>Dates</b> </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <p align="center">Don't see your conference listed? <a href="{{url('/')}}/addnew">Request to add a new conference</a></p>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#list').DataTable({
        "processing": true,
        "serverSide": true,
        "aaSorting": [ 0, "desc" ],
        "ajax": "{{ route('listview.getposts') }}",
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
        ]
    });
});
$(document).ready(function(){
    $('body').on('click','table#list tbody tr', function(){
        var clickedTRObj = $(this);
        $(this).next().find('li').each(function(key,val) {
            $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
        });
    });
});
</script>
@endsection
