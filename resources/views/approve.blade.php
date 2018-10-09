@extends('layouts.blankmenu')

@section('content')
<div class="main-content">
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
                <div class="panel-heading"><b> New Conference Request </b></div>
                <div class="panel-body">
                    {!! Form::model($conference, ['data-toggle'=>'validator']) !!}
                    <table class="table table-responsive table-bordered table-striped" style="margin-top: 10px">
                            <tbody>
                                {{csrf_field()}}
                                <tr>
                                    <td> <b>Requestor First Name</b> </td>
                                    <td> {{$conference -> firstname}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Requestor Last Name</b> </td>
                                    <td> {{$conference -> lastname}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Requestor Email</b> </td>
                                    <td> {{$conference -> email}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Conference Name</b> </td>
                                    <td> {{$conference -> conferencename}}</td>
                                </tr>
                                <tr>
                                    <td> <b>Conference URL</b> </td>
                                    <td> {{$conference -> conferenceurl}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Conference Description</b> </td>
                                    <td> {{$conference -> description}}</td>
                                </tr>
                                <tr>
                                    <td> <b>Industry Focussed</b> </td>
                                    <td> {{$conference -> industry}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Business Relevancy</b> </td>
                                    <td> {{$conference -> business}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Conference Frequency</b> </td>
                                    <td> {{$conference -> frequency}} </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label class="control-label" for="reason">Enter the Reason to Reject<span> *</span></label>
                            <textarea class="form-control" data-error="Please enter the reason to reject" id="reason" name="reason" rows="2" required></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group text-center pull-right">
                            {{ Form::submit('Reject', ['class' => 'btn btn-danger']) }}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
