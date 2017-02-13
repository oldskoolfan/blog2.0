<?php
session_start();
require __dir__ . '/../../include/mysql.php';

try {
	$id = $_POST['id'];
	$title = $_POST['title'];
	$body = $_POST['body'];
	$moodId =  $_POST['mood'];
	$userId = $_SESSION['id'];

	if (empty($title) || empty($body) || empty($moodId)) {
		throw new \Exception('All fields are required');
	}

	if (empty($id)) {
		$stmt = $con->prepare('insert blogs (title,body,mood_id, user_id)
			values(?,?,?,?)');
		$stmt->bind_param('ssii', $title, $body, $moodId, $userId);
	} else {
		$stmt = $con->prepare('update blogs set title = ?, body = ?, mood_id = ?
			where id = ?');
		$stmt->bind_param('ssii', $title, $body, $moodId, $id);
	}

	$success = $stmt->execute();

	if (!$success) {
		throw new \Exception($stmt->error);
	}

	if (empty($id)) {
		$id = $stmt->insert_id;
	}

	handleImageUpload($id, $con);

} catch (\Throwable $ex) {
	$_SESSION['msg'] = [
		'type' => 'danger',
		'text' => $ex->getMessage(),
	];
} finally {
	header('Location: ../');
}

function handleImageUpload($blogId, &$con) {
	$allowedTypes = [
		'image/jpeg',
		'image/jpg',
		'image/png',
		'image/x-png',
		'image/pjpeg',
		'image/gif',
	];

	if (!isset($_FILES['image'])) {
		return;
	}

	$tmp = $_FILES['image']['tmp_name'];
	$filename = $_FILES['image']['name'];
	$type = $_FILES['image']['type'];

	if (!file_exists($tmp)) {
		return;
	}

	$fileInfo = new finfo(FILEINFO_MIME_TYPE);

	if (!in_array(strtolower($fileInfo->file($tmp)), $allowedTypes)) {
		return;
	}

	$stream = fopen($tmp, 'r');
	$data = fread($stream, filesize($tmp));
	fclose($stream);

	// get existing image if there is one associated with this blog
	$oldImageId = 0;
	$result = $con->query('select image_id from blogs where id = ' . $blogId);
	if ($result && $result->num_rows === 1) {
		$oldImageId = $result->fetch_object()->image_id;
	} elseif (!$result) {
		throw new \Exception($con->error);
	}

	// insert new image
	$imageId = 0;
	$stmt = $con->prepare('insert into images (image_type, filename, image_data)
		values (?,?,?)');
	$stmt->bind_param('sss', $type, $filename, $data);
	$success = $stmt->execute();
	if ($success) {
		$imageId = $stmt->insert_id;
	} else {
		throw new \Exception($stmt->error);
	}

	// update blog record with imageId (id of image we just created)
	if ($imageId > 0) {
		$success = $con->query("update blogs set image_id = $imageId
			where id = $blogId");
		if (!$success) {
			throw new \Exception($stmt->error);
		}
	}

	// delete old image if we found one
	if ($oldImageId > 0) {
		$success = $con->query('delete from images where id = ' . $oldImageId);
		if (!$success) {
			throw new \Exception($con->error);
		}
	}
}
