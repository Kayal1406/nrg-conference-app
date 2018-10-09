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
      Hello {{$formdata["mngfirstname"]}},
      <td>
  </tr>
  <tr>
    <td>
      <p>A conference request has been submitted by {{$formdata["firstname"]}} {{$formdata["lastname"]}} to attend {{$formdata["confname"]}}. You are listed as the approving manager.
      Please review the information below and either approve or deny the request.</p>
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
      	<tr>
          <td>Travel details</td>
          <td> {{$formdata["travelstart"]}} to {{$formdata["travelend"]}}</td>
        </tr>
        <tr>
          <td>Registration Costs</td>
          <td> {{$formdata["reg_costs"]}}</td>
        </tr>
      	<tr>
          <td>Marketing support needed</td>
          <td> {{$formdata["support"]}}</td>
        </tr>
      	<tr>
          <td>Total Travel Cost (inclusive of air travel, lodging, car rental, etc.)</td>
          <td> {{$formdata["travelcosts"]}}</td>
        </tr>
      	<tr>
          <td>Primary role at conference</td>
          <td> {{$formdata["role"]}}</td>
        </tr>
      	<tr>
          <td>Marketing Sponsoring</td>
          <td> {{$formdata["sponsoring"]}}</td>
        </tr>
      	<tr>
          <td>Benefits of Sponsoring</td>
          <td> {{$formdata["benefits"]}}</td>
        </tr>
      	<tr>
          <td>Business Unit Sponsoring</td>
          <td> {{$formdata["business"]}}</td>
        </tr>
      </table>
      </td>
    </tr>
    <tr>
        <td>
            <a href="{{ url('manager_approve_appliedconference', $formdata["link"]) }}">Click this link to Approve</a>
            <a href="{{ url('manager_reject_appliedconference', $formdata["link"]) }}">Click this link to Reject</a>
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