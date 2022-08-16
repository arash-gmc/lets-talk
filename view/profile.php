
<div class="d-flex justify-content-center">
	<div class='d-flex my-3 container w-50 '>
		
			<?php if(file_exists('./view/profile-pictures/'. $username .'.jpg')){ ?>
				<img src="./view/profile-pictures/<?= $username ?>.jpg"
				 style="width: 180px ; height: 180px;object-fit: cover;"
				 class="border rounded-circle img-fluid mt-5">
			<?php }else{ ?>
				<div class="my-4"><i class="bi bi-person display-2 p-3 border-secondary border rounded-circle" ></i></div>
			<?php } ?>
			
		<div class="container d-flex flex-column mx-md-4 text-center">
			<div class="display-3 mx-3 w-100 "> <?= $username ?> </div>
			<div class="d-flex justify-content-around mt-5">
				<div class="h4"><p><?= followers_count($profile_id)?></p><p>Followers</p></div>
				<div class="h4"><p><?= followings_count($profile_id)?></p><p>Followings</p></div>
				<div class="h4"><p><?= posts_count($profile_id) ?></p><p>Posts</p></div>
			</div>
			
		</div>
		<div class="d-flex flex-column  mt-4">
			<form action='.' method="get" class="mx-3 my-2" >
				<input type="hidden" name="followed" value="<?= $profile_id ?>">
				<?php if(follow_check($viewer_id,$profile_id)){ ?>
					<button class="btn btn-outline-primary">Unfollow</button>
					<input type="hidden" name="action" value='unfollowing'>
				<?php }else{ ?>
					<button class='btn btn-primary' style="width:100px">Follow</button>
					<input type="hidden" name="action" value='following'>
				<?php } ?>
			</form>
			<button class="btn btn-primary mx-3" style="width: 100px">Message</button>	
		</div>	
	</div>
</div>


<?php include './view/posts.php' ?>


