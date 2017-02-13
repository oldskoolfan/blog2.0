<?php
require __dir__ . '/../../include/mysql.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$stmt = $con->prepare('select * from blogs where id = ?');
	$stmt->bind_param('i', $id);
	$success = $stmt->execute();
	if ($success) {
		$result = $stmt->get_result();
		if ($result->num_rows === 1) {
			$blog = $result->fetch_object();
			$title = $blog->title;
			$body = $blog->body;
			$moodId = $blog->mood_id;
			$imageId = $blog->image_id;
		}
	}
}

// check post, if have values then override
if (isset($_POST['title'])) {
	$title = $_POST['title'];
}

if (isset($_POST['body'])) {
	$body = $_POST['body'];
}

if (isset($_POST['mood'])) {
	$moodId = $_POST['mood'];
}
