<?php
session_start();
require 'mysql.php';
try {
	$body = $_POST['comment'];
	$blogId = $_POST['blog_id'];
	$userId = $_SESSION['id'];

	$stmt = $con->prepare('insert comments(body, blog_id, user_id) values (?,?,?)');
	$stmt->bind_param('sii', $body, $blogId, $userId);

	$success = $stmt->execute();
	if (!$success) {
		throw new \Exception($stmt->error);
	}
} catch (\Throwable $ex) {
	$_SESSION['msg'] = [
		'type' => 'danger',
		'text' => $ex->getMessage(),
	];
} finally {
	header('Location: ../');
}
