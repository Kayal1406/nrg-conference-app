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
        <p>The marketing team would like to request your feedback on the recent conference you participated in, "<b><a href="{{url('/conference_details')}}/{{$conferenceid}}">{{$confname}}</a></b>". As part of the conference process put in place, it is critical that we learn about your experience and track conference activity in order to evaluate future opportunities. <br />
        <a href="{{ url('survey', $conferenceid) }}">Click to provide feedback</a> and will take just a few moments of your time. </p>
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