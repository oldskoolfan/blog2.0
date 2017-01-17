<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Andrew's Blog2.0</title>

	<!-- BOOTSTRAP (BECAUSE I'M LAZY) -->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- END BOOTSTRAP -->
</head>
<body style="padding-top: 50px">
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<a href="<?= isset($home) ? $home : './' ?>" class="navbar-brand"><div class="navbar-header">Blog2.0</div></a>
		<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
			<form class="navbar-form navbar-right" method="post" action="login.php">
				<?php if (!isset($_SESSION['id'])): ?>
					<div class="form-group">
						<input name="username" type="text" placeholder="Username" class="form-control">
					</div>
					<div class="form-group">
						<input name="pass" type="password" placeholder="Password" class="form-control">
					</div>
					<button type="submit" class="btn btn-success">Sign in</button>
					<button type="button" class="btn btn-default" onclick="location.href = 'register.php'">Register</button>
				<?php else: ?>
					<?php if ($_SESSION['is_admin']): ?>
						<a class="btn btn-default" href="<?= isset($home) ? $home . 'admin' : './admin'?>">Admin</a>
					<?php endif; ?>
					<a class="btn btn-primary" href="<?= isset($home) ? $home . 'logout.php' : 'logout.php'?>">Log out</a>
				<?php endif; ?>
			</form>
		</div>
	</div>
</nav>
