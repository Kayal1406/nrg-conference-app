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
                <div class="panel-heading"><b>Conference Admin Page</b></div>
                <div class="panel-body">
                        <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="home">
                            <thead>
                                <tr>
                                    <td> <b>Conference Name</b> </td>
                                    <td> <b>Action</b></td>
                                    <td> <b>Status</b></td>
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
    oTable = $('#home').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('home.gethome') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },
        "columns": [
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.id+'">'+oData.conferencename+'</a>');
                }
            },
            {data: 'id', name: 'id' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a class="btn btn-primary" href="{{url('/edit')}}/'+oData.id+'">Edit</a> ' + '<a class="btn btn-danger delete" onclick="return confirm(\'Are you sure you want to delete this conference?\')" href="{{url('/delete')}}/'+oData.id+'">Delete</a>');
                },
            },
            {data: 'is_active', name: 'is_active' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    if(oData.is_active == "1")
                        $(nTd).html('<a class="btn btn-danger change-status" id="'+oData.id+'">Inactive</a>');
                    else
                        $(nTd).html('<a class="btn btn-success change-status" id="'+oData.id+'">Active</a>');
                        
                }
            }, 
        ]
    });
});

$('body').on('click','table#home tbody tr', function(){
    var clickedTRObj = $(this);
    $(this).next().find('li').each(function(key,val) {
        $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
    });
});
</script>
@endsection