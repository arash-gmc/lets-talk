
<div class="d-flex justify-content-center">
	<div class='d-flex my-3 container w-75 '>
		
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
				<a data-bs-toggle="modal" data-bs-target="#followers-modal">
					<div class="h4" style="cursor: pointer;"><p><?= followers_count($profile_id)?></p><p>Followers</p></div>
				</a>
				<a data-bs-toggle="modal" data-bs-target="#followings-modal">	
					<div class="h4" style="cursor: pointer;"><p><?= followings_count($profile_id)?></p><p>Followings</p></div>
				</a>	
				<div class="h4"><p><?= posts_count($profile_id) ?></p><p>Posts</p></div>
			</div>
			
		</div>


		<?php if ($user_id != $profile_id ) { ?>
			<div class="d-flex flex-column  mt-4">
				<form action='.' method="get" class="mx-3 my-2" >
					<input type="hidden" name="followed" value="<?= $profile_id ?>">
					<?php if(follow_check($user_id,$profile_id)){ ?>
						<button class="btn btn-outline-primary" style="width:100px">Unfollow</button>
						<input type="hidden" name="action" value='unfollowing'>
					<?php }else{ ?>
						<button class='btn btn-primary' style="width:100px">Follow</button>
						<input type="hidden" name="action" value='following'>
					<?php } ?>
				</form>
				<a href=".?action=chat-page&contact=<?= $profile_id ?>#message1" class="btn btn-primary mx-3" style="width: 100px">Message</a>	
			</div>
		<?php }else{ ?>
			<div class="d-flex flex-column mt-5">
				<div style="position: relative;">
					<a href=".?action=notifications" class="btn btn-primary">Notifications</a>
					<?php if($unseen_notification){ ?>
						<div style="position: absolute;font-size: 16px;background-color: red;top: -10px;right: -10px;color: white;border-radius: 10px; text-align: center;width: 20px;height: 24px"><?= $unseen_notification ?></div>
					<?php } ?>
				</div>	
				<div style="position: relative;" class="d-flex">
					<a href=".?action=inbox" class="btn btn-primary my-3 mx-0">Messages</a>
					<?php if($unseen_messages){ ?>
						<div style="position: absolute;font-size: 16px;background-color: red;top: 6px;right: 8px;color: white;border-radius: 10px; text-align: center;width: 20px;height: 24px"><?= $unseen_messages ?></div>
					<?php } ?>
				</div>
			</div>



		<?php } ?>	


	</div>
</div>



<div class="modal fade" id="followings-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Followings of <?= $username ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column">
      	<?php $ids = get_followings($profile_id) ?>
      		<?php if ($ids){ ?>
      		  <?php foreach ($ids as $id) : ?>
      		  		<a href=".?action=profile&profile_id=<?= $id ?>">
		      		 	<div class="d-flex border-bottom my-2 align-content-center mx-3">
		      		 		<div class="mb-2">
		      		 			<?php if(file_exists('./view/profile-pictures/'. find_username($id) .'.jpg')){ ?>
									<img src="./view/profile-pictures/<?= find_username($id) ?>.jpg"
									 style="width: 60px ; height: 60px;object-fit: cover;"
									 class="border rounded-circle img-fluid">
								<?php }else{ ?>
									<div class="my-2"><i class="bi bi-person h3 p-2 border-secondary border rounded-circle" ></i></div>
								<?php } ?>
		      		 		</div>
		      		 		<div class=" w-75 mt-2">
		      		 			<p class="h3 text-center"><?= find_username($id) ?></p>
		      		 		</div>
		      		 	</div>
		      		 </a>
      		<?php endforeach; ?>
      		<?php }else{ ?>
      			<p class="text-center h4 my-4">There is no followings for this user</p>
      		<?php } ?>
	      </div>
      	
	      
	    </div>
	  </div>
	</div>
</div>



<div class="modal fade" id="followers-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Followers of <?= $username ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column">
      	<?php $ids = get_followers($profile_id) ?>
      		<?php if ($ids){ ?>
      		  <?php foreach ($ids as $id) : ?>
      		  		<a href=".?action=profile&profile_id=<?= $id ?>">
		      		 	<div class="d-flex border-bottom my-2 align-content-center mx-3">
		      		 		<div class="mb-2">
		      		 			<?php if(file_exists('./view/profile-pictures/'. find_username($id) .'.jpg')){ ?>
									<img src="./view/profile-pictures/<?= find_username($id) ?>.jpg"
									 style="width: 60px ; height: 60px;object-fit: cover;"
									 class="border rounded-circle img-fluid">
								<?php }else{ ?>
									<div class="my-2"><i class="bi bi-person h3 p-2 border-secondary border rounded-circle" ></i></div>
								<?php } ?>
		      		 		</div>
		      		 		<div class=" w-75 mt-2">
		      		 			<p class="h3 text-center"><?= find_username($id) ?></p>
		      		 		</div>
		      		 	</div>
		      		 </a>
      		<?php endforeach; ?>
      		<?php }else{ ?>
      			<p class="text-center h4 my-4">There is no followers for this user</p>
      		<?php } ?>
	      </div>
      	
	      
	    </div>
	  </div>
	</div>
</div>





<?php include './view/posts.php' ?>


