<html>
<head>
<style type="text/css">
body{
    font-family:Arial, sans-serif;
    font-size:14px;
}
table, td, tr{
    font-size:14px;
}
td {
    padding-bottom:10px;
    vertical-align:top;
}
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td>
      Hello Conference Manager,
      <td>
  </tr>
  <tr>
      <td>
      <p>A new conference request has been submitted by <b>{{$firstname}} {{$lastname}}</b> to participate in <b>"{{$formdata["conferencename"]}}"</b>.       Please review the information below and either approve or deny the request.<br/>
      </td>
  </tr>
  <tr>
    <td>
      <table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td>Conference Name</td>
            <td>: "<a href="{{url('/conference_details')}}/{{$formdata["id"]}}"><b>{{$formdata["conferencename"]}}</b></a>"</td>
          </tr>
          <tr>
            <td>Conference Website</td>
            <td>: <a href="{{$formdata["conferenceurl"]}}">{{$formdata["conferenceurl"]}}</a></td>
          </tr>
          <tr>
            <td>Conference description</td>
            <td>: {{$formdata["description"]}}</td>
          </tr>
          <tr>
            <td>Industry</td>
            <td>: {{$formdata["industry"]}}</td>
          </tr>
          <tr>
            <td>Conference relevance</td>
            <td>: {{$formdata["business"]}}</td>
          </tr>
          <tr>
            <td>Requestor Name</td>
            <td>: <b>{{$firstname}} {{$lastname}}</b></td>
          </tr>
        <tr>
          <td>Requestor email address</td>
          <td>: <a href="mailto:{{$email}}" target="_top">{{$formdata["email"]}}</a></td>
        </tr>
        <tr>
          <td>Conference frequency</td>
          <td>: {{$formdata["frequency"]}}</td>
        </tr>
        </tbody>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="1" cellspacing="0" cellpadding="10">
        <caption>Relative Conference Matches</caption>
     		<thead>
     			<tr>
     				<th>Conference Name</th>
     				<th>Status</th>
     			</tr>
     		</thead>
     		<tbody>
      		@forelse ($similar as $s)
      		<tr>
              <td><a href="{{url('/conference_details')}}/{{$s["id"]}}">{{ $s["conferencename"] }}</a></td>
              <td>{{$s["status_sm"]}}</td>
          </tr>
          @empty
          <tr>
            <td colspan="2">
              No data available
            </td>
          </tr>
          @endforelse
      	</tbody>
      </table>
    </td>
  </tr>
  <tr>
    <td>
        <a href="{{ url('approve_newconference', $formdata['link']) }}">Click this link to Approve</a>
        <a href="{{ url('reject_newconference', $formdata['link']) }}">Click this link to Reject</a>
    </td>
  </tr>
    <tr>
        <td>
        Thank you,
        <br/>
        Conference Admin
        </td>
    </tr>
</table>
</body>
</html>