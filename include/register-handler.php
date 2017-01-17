<?php
session_start();

require 'mysql.php';

try {
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$confirm = $_POST['confirm'];

	if (empty($username) || empty($pass) || empty($confirm)) {
		throw new \Exception('All fields are required');
	}

	if ($pass !== $confirm) {
		throw new \Exception('Passwords must match');
	}

	$stmt = $con->prepare('select * from users where username = ?');
	$stmt->bind_param('s', $username);
	$success = $stmt->execute();

	if ($success) {
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			throw new \Exception('Username already taken');
		}

		// all good; create new user
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		$stmt = $con->prepare('insert users(username, password) values(?,?)');
		$stmt->bind_param('ss', $username, $hash);
		$success = $stmt->execute();
		if ($success) {
			$_SESSION['msg'] = [
				'type' => 'success',
				'text' => 'User created successfully!',
			];
		} else {
			throw new \Exception($stmt->error);
		}
	} else {
		throw new \Exception($stmt->error);
	}

} catch (\Throwable $ex) {
	$_SESSION['msg'] = [
		'type' => 'danger',
		'text' => $ex->getMessage(),
	];
} finally {
	header('Location: ../register.php');
}
