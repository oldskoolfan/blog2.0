<?php
$home = '../';
$isAdminPage = true;
include '../include/header.php';
include 'include/get-moods.php';
include 'include/get-blog.php';
$openForm = isset($_SESSION['msg']) || isset($blog);
?>
<div class="container">
	<h1>Blog Admin</h1>
	<?php include '../include/alert.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="#blog-form" data-toggle="collapse" aria-expanded="false" aria-controls="blog-form">
				<h3 class="panel-title">Blog Form</h3>
			</a>
		</div>
		<div id="blog-form" class="panel-body <?= $openForm ? 'collapse.in' : 'collapse' ?>">
			<form action="include/blog-handler.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?=isset($id) ? $id : '' ?>">
				<div class="form-group">
					<label for="title">Title</label>
					<input id="title" name="title" class="form-control" type="text" value="<?= isset($title) ? $title : '' ?>">
				</div>
				<div class="form-group">
					<label for="mood">Current Mood</label>
					<select id="mood" name="mood" class="form-control">
						<option></option>
						<?php while($mood = $moods->fetch_object()): ?>
							<option <?= isset($moodId) && $moodId == $mood->id ? 'selected' : '' ?> value="<?=$mood->id?>" title="<?=$mood->mood_description?>"><?=$mood->mood_name?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input id="image" name="image" type="file">
				</div>
				<div class="form-group">
					<label for="body">Body</label>
					<textarea id="body" name="body" class="form-control"><?= isset($body) ? $body : '' ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Save Blog</button>
				<a class="btn btn-default" href="./">Cancel</a>
			</form>
		</div>
	</div>
	<?php include '../include/get-blogs.php' ?>
</div>
<?php include '../include/footer.php' ?>
