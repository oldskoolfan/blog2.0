<?php
require 'mysql.php';

$id = $_GET['id'] ?? 0;

if (is_numeric($id)) {
	$result = $con->query("select image_type, image_data from images where
		id = $id");
	if ($result && $result->num_rows === 1) {
		$img = $result->fetch_object();
		header('Content-type: ' . $img->image_type);
		echo $img->image_data;
	}
}
