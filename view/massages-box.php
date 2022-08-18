


<div class="d-flex justify-content-center">
	<div class="w-100 mx-2 d-flex flex-column">

		<div class="bg-secondary text-white text-center h2 p-3 rounded ps-5">My Inbox</div>

		<?php foreach ($contacts as $contact_id) : ?>

		<?php $username = find_username($contact_id); ?>
		<a href=".?action=chat-page&contact=<?= $contact_id ?>#message1">
			<div class="d-flex justify-content-between py-3 border-bottom mx-lg-5 mx-2">
				<div style="width: 70px" class="">
					<?php if(file_exists('./view/profile-pictures/'. $username .'.jpg')){ ?>
						<img src="./view/profile-pictures/<?= $username ?>.jpg"
						 style="width: 60px ; height: 60px;object-fit: cover;"
						 class=" rounded-circle img-fluid">
					<?php }else{ ?>
						<div class="my-4"><i class="bi bi-person display-2 p-3 border-secondary border rounded-circle" ></i></div>
					<?php } ?>
				</div>

				<div class="d-flex justify-content-center align-content-center " style="height: 50px;width: 80%;position: relative;">
					<p class="text-center lead " style="overflow: hidden;width: 95%">
						<?= get_last_message($user_id,$contact_id) ?>
					</p>
					<?php if(check_unseen_messages($user_id,$contact_id)) { ?>
					<div style="position: absolute;top: 45% ; right: 40px;" class="bg-primary text-white rounded-circle p-1">
						<?= check_unseen_messages($user_id,$contact_id) ?>
					</div>
					<?php } ?>	
				</div>
			</div>
		</a>	
		
			
	

		<?php endforeach ?>
	</div>

</div>

