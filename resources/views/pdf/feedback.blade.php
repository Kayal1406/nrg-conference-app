<html>
<head>
	<title>Feedback Report</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<td>Conference Name</td>
				<td>Participant Name</td>
				<td>Participant Email</td>
				<td>Approval Manager</td>
				<td>Experience</td>
				<td>Actions</td>
				<td>Recommendations</td>
				<td>Entered Leads</td>
			</tr>
		</thead>
		<tbody>
			@foreach($feedback as $fb)
            <tr>
                <td> {{$fb -> conferencename}} </td>
                <td> {{$fb -> conferenceurl}} </td>
                <td> {{$fb -> yourname}} </td>
                <td> {{$fb -> email}} </td>
                <td> {{$fb -> approvalmanager}} </td>
                <td> {{$fb -> experience}} </td>
                <td> {{$fb -> actions}} </td>
                <td> {{$fb -> recommendations}} </td>
                <td> {{$fb -> leads}} </td>
            </tr>
            @endforeach
		</tbody>
	</table>
</body>
</html>