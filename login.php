<?php
session_start();
require 'include/mysql.php';

try {
	// create variables from post values
	$username = $_POST['username'];
	$pass = $_POST['pass'];

	if (empty($username) || empty($pass)) {
		throw new \Exception('username and password are required');
	}

	$stmt = $con->prepare('select * from users where username = ?');
	$stmt->bind_param('s', $username);

	$success = $stmt->execute();

	if ($success) {
		$result = $stmt->get_result();

		if ($result->num_rows === 0) {
			throw new \Exception('user not found');
		}

		$user = $result->fetch_object();

		if (password_verify($pass, $user->password)) {
			$_SESSION['id'] = $user->id;
			$_SESSION['is_admin'] = $user->can_edit;
			$_SESSION['username'] = $user->username;
		} else {
			throw new \Exception("passwords don't match");
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
	header('Location: ./');
}
