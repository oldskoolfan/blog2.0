<?php
session_start();
require __dir__ . '/../../include/mysql.php';

try {
	$id = $_POST['id'];
	$title = $_POST['title'];
	$body = $_POST['body'];
	$moodId =  $_POST['mood'];

	if (empty($title) || empty($body) || empty($moodId)) {
		throw new \Exception('All fields are required');
	}
	if (empty($id)) {
		$stmt = $con->prepare('insert blogs (title,body,mood_id) values(?,?,?)');
		$stmt->bind_param('ssi', $title, $body, $moodId);
	} else {
		$stmt = $con->prepare('update blogs set title = ?, body = ?, mood_id = ?
			where id = ?');
		$stmt->bind_param('ssii', $title, $body, $moodId, $id);
	}
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
