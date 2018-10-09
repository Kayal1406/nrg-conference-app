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
            <div class="panel panel-primary">
                <div class="panel-heading"><b>Your Pending Requests</b></div>
                    <div class="panel-body">
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <td> <b>Conference Name</b> </td>
                                <td> <b>Conference URL</b> </td>
                                <td> <b>Approval Status</b> </td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conference as $conf)
                            <tr>
                                <td> <a href="/conference_details/{{$conf->id}}">{{$conf -> conferencename}}</a> </td>
                                <td> <a target="_blank" href="{{$conf -> conferenceurl}}"> {{$conf -> conferenceurl}} </a></td>
                                <td> {{$conf->status_sm}}</td>
                            </tr>
                            @empty
                            <p>No requests Available</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading"><b>Applied to Existing Conference</b></div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <td> <b>Conference Name</b> </td>
                                <td> <b>Date</b> </td>
                                <td> <b>Conference Admin Approval Status</b> </td>
                                <td> <b>Manager Remarks</b> </td>
                                <td> <b>Manager Approval Status</b> </td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($apply as $a)
                            <tr>
                                <td> <a href="/conference_details/{{$conf->id}}">{{$a -> confname}}</a> </td>
                                <td> {{$a -> confstart}} </td>
                                <td> {{$a->status_sm}}</td>
                                <td> {{$a->manager_remarks}}</td>
                                <td> {{$a->status_m}}</td>
                            </tr>
                            @empty
                            <p>No requests Available</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
