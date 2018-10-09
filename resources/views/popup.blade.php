@extends('layouts.app')

@section('content')

<script>
$(document).ready(function(){
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
        <h4 class="modal-title">Enter your Email ID</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url'=>'registeruser', 'data-toggle'=>'validator']) !!}
        <div class="form-group"> 
          <input type="text" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-error="Please enter your email address" data-pattern-error="Please enter valid email address" id="useremail" name="useremail" class="form-control" required/>
          <div class="help-block with-errors"></div>
        </div>    
      </div>
      <div class="modal-footer">
        {!! Form::submit('Cancel',['data-dismiss' => 'modal', 'class' => 'btn btn-default']) !!}
        {!! Form::submit('Submit',['class' => 'btn btn-success']) !!} 
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection