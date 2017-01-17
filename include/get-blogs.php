<?php
require 'mysql.php';

$blogs = $con->query('select * from blogs order by date_created desc');
?>
<?php while ($blog = $blogs->fetch_object()): ?>
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<h3 class="panel-title pull-left"><?= $blog->title ?></h3>
			<?php if($isAdminPage): ?>
				<a href="delete.php?id=<?=$blog->id?>" class="btn btn-xs btn-danger pull-right">Delete</a>
				<a href="./?id=<?=$blog->id?>" class="pull-right btn btn-xs btn-default" style="margin-right:5px">Edit</a>
			<?php endif; ?>
		</div>
		<div class="panel-body"><?= $blog->body ?></div>
	</div>
<?php endwhile; ?>
