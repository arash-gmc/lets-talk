<div class='d-flex mx-5 my-5 container'>
	<?php if(file_exists('./view/profile-pictures/'. $username .'.jpg')){ ?>
		<img src="./view/profile-pictures/<?= $username ?>.jpg"
		 style="width: 180px ; height: 180px;object-fit: cover;"
		 class="border rounded-circle img-fluid">
	<?php }else{ ?>
		<i class="bi bi-person display-2 p-3 border-secondary border rounded-circle"></i>
	<?php } ?>
	<div class="display-2 mx-4"> <?= $username ?> </div>
	<form action='.' method="get">
		<input type="hidden" name="followed" value="<?= $profile_id ?>">
		<?php if(follow_check($viewer_id,$profile_id)){ ?>
			<button class="btn btn-outline-primary">Unfollow</button>
			<input type="hidden" name="action" value='unfollowing'>
		<?php }else{ ?>
			<button class='btn btn-primary'>Follow</button>
			<input type="hidden" name="action" value='following'>
		<?php } ?>
	</form>	
</div>



<div>
	<?php foreach ($posts as $post) : ?>
		<div class="container mt-2 border-bottom d-flex" style="height: 110px;">
			<div class="me-3 mt-2">
				<?php if(file_exists('./view/profile-pictures/'. $username .'.jpg')){ ?>
					<img src="./view/profile-pictures/<?= $username ?>.jpg"
					 style="width: 60px ; height: 60px;object-fit: cover;"
					 class="border rounded-circle img-fluid">
				<?php }else{ ?>
					<i class="bi bi-person h2 p-2 border-secondary border rounded-circle"></i>
				<?php } ?>	
				<p class="text-muted small mt-3 text-center"><?= $username ?></p>
			</div>
			<p class="mt-2"><?= $post['post'] ?></p>
			
		</div>

	<?php endforeach; ?>	
</div>




