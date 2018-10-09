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
                {!! Form::open(array('url' => 'saveleads', 'data-toggle' => 'validator')) !!}
                <div class="form-group">
                    <label class="control-label" for="company">Company Name<span> *</span></label>
                    <input type="text" id="company" data-error="Please enter the company name" class="form-control" name="company" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">  
                    <input type="hidden" name="conferenceid" value="{{$apply->conferenceid}}" required/>
                    <input type="hidden" name="user_id" value="{{$apply->user_id}}" required/>
                    <label class="control-label" for="firstname">First Name<span> *</span></label>
                    <input type="text" maxlength="25" id="firstname" data-error="Please enter your first name" class="form-control" name="firstname" required/>
                    <div class="help-block with-errors"></div>
                </div>                     
                <div class="form-group">
                    <label class="control-label" for="lastname">Last Name<span> *</span></label>
                    <input type="text" maxlength="25" id="lastname" data-error="Please enter your last name" class="form-control" name="lastname" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                <label class="control-label" for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="email">Email Address<span> *</span></label>
                <input type="text" data-error="Please enter email address" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-pattern-error="Please enter valid email address" class="form-control" id="email" name="email" required/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="phone">Phone Number</label>
                <input type="text" id="phone" pattern="^(\(?\+?[0-9]*\)?)?[3-9_\- \(\)]*$" data-pattern-error="Please enter correct phone number" class="form-control" name="phone"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="notes">Notes</label>
                <textarea id="notes" class="form-control" name="notes"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            {!! Form::submit('Submit',['class' => 'btn btn-success pull-right']) !!}
            {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
