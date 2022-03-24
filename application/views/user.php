<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<h1>login</h1>
	<form action="<?php echo base_url(). 'User/auth'; ?>" method="post">
		
		<input type="email" name="email" placeholder="email">
		<input type="password" name="password" placeholder="password">
		<input type="submit" name="submit">
		<a href="<?php echo base_url().'User/signup'; ?>">Signup</a>
	</form>

</body>
</html>