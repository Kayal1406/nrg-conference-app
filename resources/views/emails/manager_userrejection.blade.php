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
      Hello {{$firstname}},
      <td>
  </tr>
  <tr>
      <td>
	      <p>Your recent request to participate in "<b><a href="{{url('/conference_details')}}/{{$conferenceid}}">{{$confname}}</a></b>" has been denied for the following reason(s):
			<ul>
				<li>{{$manager_remarks}}</li>
			</ul>
			If you have any questions regarding this notification, please contact your approving manager.
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
