<?php if (isset($_SESSION['msg'])): ?>
<div class="alert alert-<?=$_SESSION['msg']['type']?>" role="alert">
	<?=$_SESSION['msg']['text']?>
</div>
<?php $_SESSION['msg'] = null; endif; ?>
