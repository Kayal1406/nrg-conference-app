@extends('layouts.blankmenu')

@section('content')
<div class="main-content">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Conference Request</b></div>
                <div class="panel-body">
                    {!! Form::model($apply, ['data-toggle'=>'validator']) !!}
                    <table class="table table-responsive table-bordered table-striped" style="margin-top: 10px">
                            <tbody>
                                {{csrf_field()}}
                                <tr>
                                    <td> <b>Requestor First Name</b> </td>
                                    <td> {{$apply->firstname}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Requestor Last Name</b> </td>
                                    <td> {{$apply->lastname}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Requestor Email</b> </td>
                                    <td> {{$apply->email}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Manager Email</b> </td>
                                    <td> {{$apply->mngemail}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Conference Name</b> </td>
                                    <td> {{$apply->confname}}</td>
                                </tr>
                                <tr>
                                    <td> <b>Conference URL</b> </td>
                                    <td> {{$apply->confurl}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Conference Start Date</b> </td>
                                    <td> {{$apply->confstart}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Conference End Date</b> </td>
                                    <td> {{$apply->confend}}</td>
                                </tr>
                                @if($apply->travelstart)
                                <tr>
                                    <td> <b>Travel Start Date</b> </td>
                                    <td> {{$apply->travelstart}} </td>
                                </tr>
                                <tr>
                                    <td> <b>Travel End Date</b> </td>
                                    <td> {{$apply->travelend}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td> <b>Total Travel Costs</b> </td>
                                    <td> ${{$apply->travel_cost}}</td>
                                </tr>
                                <tr>
                                    <td> <b>Deliverables Needed</b> </td>
                                    <td>{{ ($apply->deliverables != '' ? $apply->deliverables : '-') }}</td>
                                </tr><tr>
                                    <td> <b>Role at the Conference</b> </td>
                                    <td> {{$apply->role}}</td>
                                </tr>
                                <tr>
                                    <td> <b>Business Unit that is Sponsoring</b> </td>
                                    <td>{{ ($apply->business != '' ? $apply->business : '-') }}</td>
                                </tr>
                                <tr>
                                    <td> <b>Benefits of Sponsoring</b> </td>
                                    <td>{{ ($apply->benefits != '' ? $apply->benefits : '-') }}</td>
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
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
