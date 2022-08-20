<div class="row d-flex justify-content-center">
	<div class="mx-sm-4 col-xl-8 col-md-10 mx-auto mt-2">
	<?php if($notifications) { ?>
		<?php foreach ($notifications as $notif) : ?>

			<div class="d-flex border-bottom border-secondary mx-5 py-2" <?php if($notif['seen']==null){echo 'style="background-color: #ccfcf9"'; } ?>>

				<div class="mx-2">
											<?php $notifications_owner = find_username($notif['from_id']); ?>
											<?php if(file_exists('./view/profile-pictures/'.$notifications_owner.'.jpg')){ ?>
												<a href=".?action=profile&profile_id=<?= $notif['from_id'] ?>"><img src="./view/profile-pictures/<?= $notifications_owner ?>.jpg"
												 style="width: 30px ; height: 30px;object-fit: cover;"
												 class="border rounded-circle img-fluid"></a>
											<?php }else{ ?>
												<i class="bi bi-person h1 p-2 border-secondary border rounded-circle"></i>
											<?php } ?>
										</div>

				<p><?= $notif['text'] ?></p>

			</div>

		<?php endforeach ?>
	<?php }else{ ?>
		<p>There is no notifications for you.</p>	

	<?php } ?>	
	</div>
</div>