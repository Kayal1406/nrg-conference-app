@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Approved Conferences</b></div>
                <div class="panel-body">
                    <table cellspacing="0" width="100%" class="table table-responsive table-bordered table-striped display responsive nowrap" id="dashboard">
                        <thead>
                            <tr>
                                <td> <b>Conference Name</b> </td>
                                <!--<td> <b>Conference URL</b> </td>-->
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
    oTable = $('#dashboard').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('/.getdashboard') }}",
        "language": {
            "zeroRecords": "No Data Available"
        },    
        "columns": [
            {data: 'conferencename', name: 'conferencename' ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<a href="{{url('/leads')}}/'+oData.id+'">'+oData.conferencename+'</a>');
                }
            },
            // {data: 'conferenceurl', name: 'conferenceurl' ,
            //     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            //         $(nTd).html('<a target="_blank" href="'+oData.conferenceurl+'">'+oData.conferenceurl+'</a>');
            //     }
            // },
        ]
    });
    $('#dashboard').css( 'display', 'oTable' );
        oTable.responsive.recalc();
    });

$(document).ready(function(){

    $('body').on('click','table#dashboard tbody tr', function(){
        var clickedTRObj = $(this);
        $(this).next().find('li').each(function(key,val) {
            $(this).find('span.dtr-data').html(clickedTRObj.find('td:eq('+$(this).attr('data-dtr-index')+')').html());
        });
    });


    if(!$("#cookieEmail").val())
      $('#myModal').modal('show');
});
</script>

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sign In</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url'=>'registeruser','id' => 'registerForm', 'data-toggle'=>'validator']) !!}
        <input type="hidden" value="{{Request::url()}}" id="url" name="url"/>
        <div class="form-group">
          <label for="useremail">Enter your email id</label> 
          <input type="text" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-error="Please enter your email address" data-pattern-error="Please enter valid email address" id="useremail" name="useremail" class="form-control" required/>
          <div class="help-block with-errors"></div>
        </div>    
      </div>
      <div class="modal-footer">
        <input data-dismiss="modal" class="btn btn-default" type="button" value="Cancel"/>
        {!! Form::submit('Submit',['class' => 'btn btn-info']) !!} 
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $( '#registerForm' ).on( 'keypress', function( e ) {
        if( e.keyCode === 13 ) {
            e.preventDefault();
            $( this ).trigger( 'submit' );
        }
    } );
</script>
@endsection
