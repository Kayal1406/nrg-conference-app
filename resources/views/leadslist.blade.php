@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Leads List</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="margin-leadslist pull-right">
                            <div class="form-group form-inline">
                                <label class="control-label labelmrt" for="conference_name">Filter by Conference Name</label>
                                <select class="form-control filter" id="conference_name" name="conference_name">
                                    <option value="">Select Conference Name</option>
                                    @foreach($conference as $conf)
                                    <option value="{{$conf->conferencename}}">{{$conf->conferencename}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="leadslist">
                        <thead>
                            <tr>
                                <td> <b>Conference Name</b> </td>
                                <td> <b>Company</b> </td>
                                <td> <b>First Name</b> </td>
                                <td> <b>Last Name</b> </td>
                                <td> <b>Email</b> </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#leadslist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('leadslist.getdata') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [        
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.conferenceid+'">'+oData.conferencename+'</a>');
                }
            },
            {data: 'company', name: 'company'},
            {data: 'firstname', name: 'firstname'},
            {data: 'lastname', name: 'lastname'},
            {data: 'email', name: 'email' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="mailto:'+oData.email+'">'+oData.email+'</a>');

                }
            },
        ]
    });

    $('#conference_name').on('change', function () {
            var conferencename = $(this).val();
        oTable.search(this.value).draw();
    });
    $('body').on('click','table#leadslist tbody tr', function(){
        var clickedTRObj = $(this);
        $(this).next().find('li').each(function(key,val) {
            $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
        });
    });
});
</script>
@endsection
