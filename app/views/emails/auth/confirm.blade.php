<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Account Setup</h2>

		<div>
			To setup your account, please complete this form: 
			<a href="{{ URL::to("/confirm/".$user->confirmation_code) }}">
				{{ URL::to("/confirm/".$user->confirmation_code) }}
			</a>
		</div>
	</body>
</html>