<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password {{ ucfirst($type) }}</h2>

		<div>
			To {{ $type }} your password, complete this form: {{ URL::to('password/reset', array($token)) }}.
		</div>
	</body>
</html>