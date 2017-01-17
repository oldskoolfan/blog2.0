<?php
include 'include/header.php';
$isAdminPage = false;
?>
<div class="jumbotron">
	<div class="container">
		<h1>Andrew's Blog2.0</h2>
		<p>This is a basic example of a blog built with php and mysql</p>
	</div>
</div>
<div class="container">
	<?php include 'include/alert.php' ?>
	<?php include 'include/get-blogs.php' ?>
</div>
<?php include 'include/footer.php' ?>
