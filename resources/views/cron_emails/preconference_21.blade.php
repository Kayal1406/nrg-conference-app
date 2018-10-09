Hello {{$firstname}},
<br/>
<br/>
Please view the details below regarding your upcoming conference:
<ul>
	<li>Conference Name: <a href="{{url('/conference_details')}}/{{$id}}">{{$confname}}</a></li> 
	<li>Conference Dates (these dates are approximate): {{$confstart}} to {{$confend}}</li>
</ul>
Please review the conference details and upload your potential leads list prior to the conference by clicking here <a href="http://127.0.0.1:8000/leads/{{$id}}">{{$confname}}</a>. This information will be shared with other NRG conference participants.
<br/>
<br/>
Thank you,
<br/>
Conference Admin
