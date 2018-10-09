@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><b>Post Conference Feedback</b></div>
                <div class="panel-body">
                        <table class="table table-responsive table-bordered table-striped" id="past"> 
                            <thead>
                                <tr>
                                    <td></td>
                                    <td> <b>Attendee Name</b> </td>
                                    <td> <b>Conference Name</b> </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
function format ( feedback ) {
    return '<table>'+
        '<tr>'+
            '<td><b>Email</b></td>'+
            '<td>'+feedback.email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Objective for participation</b></td>'+
            '<td>'+feedback.objective+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Key results from the conference</b></td>'+
            '<td>'+feedback.results+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Recommendation for attendance/sponsorship in the future</b></td>'+
            '<td>'+feedback.recommendations+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Key customers and conversations</b></td>'+
            '<td>'+feedback.key_customers+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Follow-up meetings and action items</b></td>'+
            '<td>'+feedback.actions+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Net new business opportunities</b></td>'+
            '<td>'+feedback.business_opportunities+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Other opportunities, i.e. RFPs, etc. </b></td>'+
            '<td>'+feedback.other_opportunities+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Uploaded Conference Attendees File</b></td>'+
            '<td><a href="/attendee_list_download/">'+feedback.upload_attendees+'</a></td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Uploaded Leads File</b></td>'+
            '<td>'+feedback.upload_leads+'</td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    table = $('#past').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('pastconference.getpast') }}",
        "columns": [
            {
                 "className": 'details-control',
                 "orderable": false,
                 "data"     : null,
                 "defaultContent" : ''
            },
            {data: 'yourname', name: 'yourname'},
            {data: 'email', name: 'email'},
        ],
        "order": [[1, 'asc']]
    });
    // Add event listener for opening and closing details
    $('#past tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
});
</script>
@endsection
