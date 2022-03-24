<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signup</title>
</head>
<body>
	<h1>Signup</h1>
	<form action="<?php echo base_url(). 'User/signup'; ?>" method="post">
		<input type="email" name="email" placeholder="email">
		<input type="password" name="password" placeholder="password">
		<select id="role" name="role">
		  <option value="">Choosing role</option>
		  <option value="1">Admin</option>
		  <option value="0">User</option>
		</select>
		<input type="submit" name="submit">
		<a href="<?php echo base_url().'User/index'; ?>">Login</a>
	</form>
</body>
</html>