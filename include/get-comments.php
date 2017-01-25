<?php

$stmt = $con->prepare('select c.id, c.body, c.date_created, u.username
	from comments c join users u on c.user_id = u.id where blog_id = ?');
$stmt->bind_param('i', $blog->id);
$success = $stmt->execute();
$comments = [];
if ($success) {
	$comments = $stmt->get_result();
}
