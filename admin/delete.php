<?php
session_start();
require '../include/mysql.php';

if (isset($_SESSION['is_admin']) && isset($_GET['id'])) {
	$id = $_GET['id'];
	$table = $_GET['type'] . 's'; // tables are plural
	$stmt = $con->prepare("delete from $table where id = ?");
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
