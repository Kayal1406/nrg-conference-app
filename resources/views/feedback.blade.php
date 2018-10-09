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
            <div class="panel panel-default">
                <div class="panel-heading"><b>Conference Feedback</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            {!! Form::model($feedback, ['data-toggle'=>'validator', 'class'=> 'form-horizontal', 'files'=>true]) !!}
                            <input type="hidden" name="user_id" value="{{ Cookie::get('uid') }}"/>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="conferencename">Conference Name<span> *</span></label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="conferenceid" value="{{$feedback->id}}"/>
                                        <input type="text" class="form-control" readonly data-error="Please enter conference name" id="conferencename" name="conferencename" value="{{$feedback->conferencename}}"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="yourname">Your Name<span> *</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ Cookie::get('ufn') }}" data-error="Please enter your name" id="yourname" name="yourname" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="email">Email Address<span> *</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ Cookie::get('uemail') }}" data-error="Please enter your email address" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,100}(?:\.[a-z]{6})?)$" data-pattern-error="Please Enter Valid Email Address" id="email" name="email" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="objective">Please summarize the conference and the objective for participation: <span> *</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" id="objective" data-error="Please enter this field" name="objective" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6">List of NRG attendees:</label>
                                    <div class="col-md-6">                                        
                                        <table class="table table-responsive table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td><b>Attendee</b></td>
                                                    <td><b>Email</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($attendees as $a)
                                                <tr>
                                                    <td>{{$a->firstname}} {{$a->lastname}}</td>
                                                    <td><a href="mailto:{{$a->email}}" target="_top">{{$a->email}}</a></td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="2">No Attendees are there</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="results">What were the key takeaways (results) from this conference?<span> *</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" id="results" data-error="Please enter this field" name="results" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="recommendations">Recommendation for attendance/sponsorship in the future (pros/cons):<span> *</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" id="recommendations" data-error="Please enter this field" name="recommendations" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="key_customers">List the key customers and conversations:<span> *</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" id="key_customers" data-error="Please enter this field" name="key_customers" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="actions">Indicate the follow-up meetings and action items as a result of the conference:<span> *</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" id="actions" data-error="Please enter this field" name="actions" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="business_opportunities">Indicate the net new business opportunities in dollars that resulted from conference participation, i.e. “Potentially over $100MM in CSG, CHP, off-site, etc.”<span> *</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" id="business_opportunities" data-error="Please enter this field" name="business_opportunities" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="other_opportunities">List other opportunities, i.e. RFPs, etc. <span> *</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" id="other_opportunities" data-error="Please enter this field" name="other_opportunities" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="upload_attendees">Upload Conference Attendees</label>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" id="upload_attendees" name="upload_attendees"/>
                                        <div class="help-block with-errors"></div>
                                        <a href="{{asset('uploads/Upload_Attendees_Format.xlsx')}}">Click to download Upload Attendee List Format</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="upload_leads">Upload Leads</label>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" id="upload_leads" name="upload_leads"/>
                                        <div class="help-block with-errors"></div>
                                        <a href="{{asset('uploads/Upload_Leads_Format.xlsx')}}">Click to download Upload Leads List Format</a>
                                    </div>
                                </div>

                                <div class="form-group text-center pull-right">
                                    <div class="col-md-12">
                                        <a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
                                        {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
                                    </div>
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
