<?php include 'include/header.php' ?>

<div class="container">
	<p><?php include 'include/alert.php'; ?></p>
	<p>
		<form action="include/register-handler.php" method="post">
			<div class="form-group">
				<label for="username">Username</label>
				<input id="username" name="username" type="text" class="form-control"
					value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input id="password" name="pass" type="password" class="form-control">
			</div>
			<div class="form-group">
				<label for="confirm">Confirm Password</label>
				<input id="confirm" name="confirm" type="password" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Create User</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</form>
	</p>
</div>

<?php include 'include/footer.php' ?>
