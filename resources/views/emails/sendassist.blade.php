
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
        Hello,
        <td>
    </tr>
    <tr>
        <td>
        <p>@if($user['firstname']) {{$user['firstname']}} {{$user['lastname']}}, @endif <a href="mailto:{{$user['useremail']}}">{{$user['useremail']}}</a> has sent you a potential lead during attendance at <strong>"{{$conference['conferencename']}}"</strong>.
        Lead - "<b>{{$leads['firstname']}} {{$leads['lastname']}}</b>, {{$leads['company']}}" via the <a href="{{route('/')}}">NRG Conference App</a>. Please review and add lead if applicable.</p>
        </td>
    </tr>
    <tr>
        <td>
        Thank you,
        <br/>
        @if($user['firstname']) {{$user['firstname']}} {{$user['lastname']}}, @endif <a href="mailto:{{$user['useremail']}}">{{$user['useremail']}}</a>
        </td>
    </tr>
</table>
</body>
</html>
