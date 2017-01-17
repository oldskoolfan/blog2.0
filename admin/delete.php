<?php
session_start();
require '../include/mysql.php';

if (isset($_SESSION['is_admin']) && isset($_GET['id'])) {
	$id = $_GET['id'];
	$stmt = $con->prepare('delete from blogs where id = ?');
	$stmt->bind_param('i', $id);
	$success = $stmt->execute();
	if (!$success) {
		$_SESSION['msg'] = [
			'type' => 'danger',
			'text' => $stmt->error,
		];
	}
}

header('Location: ./');
