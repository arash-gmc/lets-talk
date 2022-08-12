

<form class='container d-flex mt-5 justify-content-center' method="get" action=".">
	<input type="hidden" name="action" value="post-send">
	<input type="hidden" name="user-id" value="<?= $_SESSION['user_id'] ?>">	
	<div class="mt-3">
		<?php if(file_exists('./view/profile-pictures/'.$_SESSION['username'].'.jpg')){ ?>
			<img src="./view/profile-pictures/<?= $_SESSION['username'] ?>.jpg"
			 style="width: 80px ; height: 80px;object-fit: cover;"
			 class="border rounded-circle img-fluid">
		<?php }else{ ?>
			<i class="bi bi-person h1 border-secondary border rounded-circle"></i>
		<?php } ?>	
		<p class="text-muted small mt-2 text-center"><?= $_SESSION['username'] ?></p>
	</div>
	<textarea rows="3" cols="36" style="resize: none" class="mx-4 p-1 lead" name='post-text'></textarea>
	<button class="btn btn-primary h-25 align-self-center">Post</button>
	
</form>

<div>
	<?php foreach ($posts as $post) : ?>
		<div class="container mt-2 border-bottom d-flex" style="height: 110px;">
			<div class="me-3 mt-2">
				<?php if(file_exists('./view/profile-pictures/'.$post['username'].'.jpg')){ ?>
					<img src="./view/profile-pictures/<?= $post['username'] ?>.jpg"
					 style="width: 60px ; height: 60px;object-fit: cover;"
					 class="border rounded-circle img-fluid">
				<?php }else{ ?>
					<i class="bi bi-person h1 border-secondary border rounded-circle"></i>
				<?php } ?>	
				<p class="text-muted small mt-2 text-center"><?= $post['username'] ?></p>
			</div>
			<p class="mt-2"><?= $post['post'] ?></p>
			
		</div>

	<?php endforeach; ?>	
</div>




