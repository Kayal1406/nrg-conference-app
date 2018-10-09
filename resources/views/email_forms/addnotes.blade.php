@extends('layouts.blankmenu')

@section('content')
<div class="main-content">
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" data-dismiss="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Conference Notes</b></div>
                <div class="panel-body">
                {!! Form::open(array('url' => 'addnotes', 'data-toggle' => 'validator')) !!}
                <div class="form-group"> 
                    <input type="hidden" name="conferenceid" value="{{$apply->conferenceid}}" required/> 
                    <label class="control-label" for="useremail">Email<span> *</span></label>
                    <input type="text" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-error="Please enter your email address" data-pattern-error="Please enter valid email address" class="form-control" id="useremail" name="useremail" value="{{$apply->email}}" required/>
                    <div class="help-block with-errors"></div>
                </div>                     
                <div class="form-group">
                    <label class="control-label" for="notes">Enter Your Notes<span> *</span></label>
                    <textarea id="notes" data-error="Please enter the notes" rows="5" class="form-control" name="notes" required></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group text-center pull-right">
                    {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
