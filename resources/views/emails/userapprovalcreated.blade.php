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
        Hello {{$dataone['firstname']}},
        <td>
    </tr>
    <tr>
    	<td>
	        <p>Your recent request to participate in "<b>{{$dataone['conferencename']}}</b>" has been approved. <br/>
	        Please submit your detailed request by completing the <a href="{{url('/')}}/apply/{{$dataone['id']}}">Request to Attend</a>. <br/>
	        If you have any questions regarding this notification, please contact the Conference Manager.
			<a href="mailto:{{$email}}">Send Queries</a>
	    	</p>
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