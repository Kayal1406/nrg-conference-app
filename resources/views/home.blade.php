@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="background-color: #f0f0f0">
                <div class="panel-heading" style="background-color: #DCDCDC"><b>Supreme Manager Page - Need to be integrated with Salesforce</b></div>
                <div class="panel-body">
                        <table class="table table-responsive table-bordered table-striped text-center datatables" style="margin-top: 10px">
                            <thead>
                                <tr>
                                    <td> <b>Conference Name</b> </td>
                                    <td> <b>Date</b> </td>
                                    <td> <b>Location</b> </td>
                                    <td> <b>Industry</b> </td>
                                    <td> <b>Action</b></td>
                                    <td> <b>Status</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($conference as $conf)
                                <tr>
                                    <td> <a href="{{ url('leads_supmng', $conf->id) }}"> {{$conf -> conferencename}} </a> </td>
                                    <td> {{$conf -> start_date}} </td>
                                    <td> {{$conf -> conference_location}} </td>
                                    <td> {{$conf -> industry}} </td>
                                    <td><a href="#" class="btn btn-primary">Edit</a></td>
                                    <td><button class="activeBtn btn btn-success">Active</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection