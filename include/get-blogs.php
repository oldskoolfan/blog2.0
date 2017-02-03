<?php
require 'mysql.php';

$blogs = $con->query('select * from blogs order by date_created desc');
?>
<?php while ($blog = $blogs->fetch_object()): ?>
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<h3 class="panel-title pull-left"><?= $blog->title ?></h3>
			<?php if($isAdminPage): ?>
				<a href="delete.php?id=<?=$blog->id?>&type=blog" class="btn btn-xs btn-danger pull-right" onclick="return confirm('Are you sure?')">Delete</a>
				<a href="./?id=<?=$blog->id?>" class="pull-right btn btn-xs btn-default" style="margin-right:5px">Edit</a>
			<?php else: ?>
				<span class="pull-right">Posted on <?=date_format(date_create($blog->date_created), 'l, F jS, Y \a\t g:i a')?></span>
			<?php endif; ?>
		</div>
		<div class="panel-body">
			<img class="img-responsive center-block" src="<?=$home ?? './'?>include/get-img.php?id=<?=$blog->image_id?>" alt="img">
			<p class="blog-content"><?= $blog->body ?></p>
			<?php if (!$isAdminPage && isset($_SESSION['id'])): ?>
				<div class="comment-form">
					<h4>Post Comment</h4>
					<form action="include/post-comment.php" method="post">
						<input type="hidden" name="blog_id" value="<?=$blog->id?>">
						<div class="form-group">
							<textarea class="form-control" name="comment" placeholder="Add your comment here, <?=$_SESSION['username']?>!"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Add Comment</button>
					</form>
				</div>
			<?php endif; ?>
			<div class="comment-section">
				<?php include 'get-comments.php' ?>
				<?php if (get_class($comments) === 'mysqli_result' && $comments->num_rows > 0): ?>
					<h4>Comments</h4>
					<?php foreach ($comments as $comment): ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<span>
								Posted by <strong><?=$comment['username']?></strong> on <?=date_format(date_create($comment['date_created']), 'l, F jS, Y \a\t g:i a')?>
								</span>
								<?php if($isAdminPage): ?>
									<a href="delete.php?id=<?=$comment['id']?>&type=comment" class="btn btn-xs btn-danger pull-right" onclick="return confirm('Are you sure?')">Delete</a>
								<?php endif; ?>
							</div>
							<div class="panel-body comment-text"><?=$comment['body']?></div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<h4>No comments yet</h4>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>
