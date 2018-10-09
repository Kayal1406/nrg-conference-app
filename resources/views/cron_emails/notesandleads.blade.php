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
      Hello {{$formdata["firstname"]}},
      </td>
  </tr>
  <tr>
    <td>
      Your conference begins tomorrow. Please review the details below:
    </td>
  </tr>
  <tr>
    <td>
      <table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>Conference Name</td>
            <td>: "<b><a href="{{url('/conference_details')}}/{{$formdata['conferenceid']}}">{{$formdata["confname"]}}</a></b>"</td>
        </tr>
        <tr>
            <td>Conference Dates (these dates are approximate)</td>
            <td>: {{$formdata["confstart"]}} to {{$formdata["confend"]}}</td>
        </tr>
        <tr>
            <td colspan="2">
                <p>NRG participants</p>
                <table width="100%" border="1" cellspacing="0" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Email Address</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($participants as $part)
                        <tr>
                        <td>{{ $part['lastname'] }}</td>
                        <td>{{ $part['firstname'] }}</td>
                        <td><a href="mailto:{{ $part['email'] }}" target="_top">{{ $part["email"] }}</a></td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="4">No participants yet</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
        <a href="{{ url('/addnotes_email', $formdata["id"]) }}">Click to add a note</a>
        <a href="{{ url('/addleads_email', $formdata["id"]) }}">Click to add a lead</a>
    </td>
</tr>
<tr>
  <td>
  <p>You are requested to add notes pertinent to the conference for the benefit of other attendees as well as for evaluation of future opportunities and ROI as a result of this conference. <br />
  Additionally, please add any leads you encounter during or immediately after the conference by using the link above. These notes and leads will be recorded in the conference web app as well as synced directly into Salesforce.</p>
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