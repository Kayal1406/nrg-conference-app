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
        <p>Your recent request to participate in "<b><a href="{{url('/conference_details')}}/{{$conferenceid}}">{{$confname}}</a></b>" has been approved by {{$mngemail}}.<br/>
        Please register for your conference and make your travel plans if needed. </p>
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