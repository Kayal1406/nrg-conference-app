@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Post Conference Feedback</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-4 labelmrt" for="conferencename">Enter Conference Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control conference-name typeahead tt-query" maxlength="350" id="conferencename" name="conferencename" />
                            </div>
                        </div>
                    </div>

                    <div id="demo" class="panel-collapse collapse">
                        <div class="table-responsive">
                            <table cellspacing="0" width="100%" class="table table-bordered table-striped" id="past">
                                <thead>
                                    <tr>
                                        <td> <b>Attendee Name</b> </td>
                                        <td> <b>Attendee Email</b> </td>
                                        <td> <b>Conference Name</b> </td>
                                        <td> <b>Reason for Attending</b> </td>
                                        <td> <b>About Market and Competitors</b> </td>
                                        <td> <b>Scheduled Meetings</b> </td>
                                        <td> <b>Attended Meetings</b> </td>
                                        <td> <b>Contacting targeted attendees</b> </td>
                                        <td> <b>Follow-up</b> </td>
                                        <td> <b>Recommendations in future</b> </td>
                                        <td> <b>People attended</b> </td>
                                        <td> <b>Companies attended</b> </td>
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
$('.typeahead').on('typeahead:selected', function(evt, item) {
        $.ajax(
        {
            url: "{{url('/feedbackdata')}}",
            data: {"cname": item},
            success: function (data)
            {
                $('#demo').show();
                if ($.fn.DataTable.isDataTable("#past")) {
                  $('#past').DataTable().clear().destroy();
                }
                var table = $('#past').DataTable({
                    "processing": true,
                    "responsive": true,
                    data: data,
                    "language": {
                        "zeroRecords": "No Data Available"
                    },
                    columns: [
                        {data: 'firstname', name: 'firstname'},
                        {data: 'email', name: 'email'},
                        {data: 'conferencename', name: 'conferencename'},
                        {data: 'reason', name: 'reason'},
                        {data: 'competitors', name: 'competitors'},
                        {data: 'scheduled', name: 'scheduled'},
                        {data: 'attended', name: 'attended'},
                        {data: 'personal_contacts', name: 'personal_contacts'},
                        {data: 'additional_plans', name: 'additional_plans'},
                        {data: 'attendees', name: 'attendees'},
                        {data: 'companies', name: 'companies'},
                        // {data: 'upload_attendees', name: 'upload_attendees',
                        //     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        //         $(nTd).html('<a href="/attendee_list_download/'+oData.id+'">'+oData.upload_attendees+'</a>');
                        //     }
                        // },
                        // {data: 'upload_leads', name: 'upload_leads',
                        //     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        //         $(nTd).html('<a href="/leads_list_download/'+oData.id+'">'+oData.upload_leads+'</a>');
                        //     }
                        // },
                    ],
                });
                $('body').on('click','table#past tbody tr', function(){
                    var clickedTRObj = $(this);
                    $(this).next().find('li').each(function(key,val) {
                        $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
                    });
                });
            }
        });
        
    });
</script>
<style type="text/css">
.bs-example {
    font-family: sans-serif;
    position: relative;
    margin: 100px;
}

.typeahead:focus {
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
    font-size: 16px;  /* Set suggestion dropdown font size */
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
</style>
@endsection