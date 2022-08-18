
<div>
	
	<div class="d-flex bg-secondary text-white p-2 h2 " style="position: fixed;top: 0;left: 0;right: 0;z-index: 5">
		<div class="mx-3">
			<a href=".?action=inbox"><i class="bi bi-arrow-left h1"></i></a>
		</div>
		<div class="d-flex justify-content-center w-100">
			<p class="text-center">
				<?= find_username($contact) ?>  
			</p>
		</div>
	</div>
	<div class="justify-content-between d-none d-xxl-flex" style="position: fixed;top: 40%;left: 10px;right: 10px">
		<div style="width: 70px" class="">
			<?php $username = find_username($contact) ?>
			<?php if(file_exists('./view/profile-pictures/'. $username .'.jpg')){ ?>
				<img src="./view/profile-pictures/<?= $username ?>.jpg"
				 style="width: 60px ; height: 60px;object-fit: cover;"
				 class=" rounded-circle img-fluid">
			<?php }else{ ?>
				<div class=""><i class="bi bi-person h1 p-2 border-secondary border rounded-circle" ></i></div>
			<?php } ?>
		</div>

		<div style="width: 70px" class="">
			<?php $username = find_username($viewer) ?>
			<?php if(file_exists('./view/profile-pictures/'. $username .'.jpg')){ ?>
				<img src="./view/profile-pictures/<?= $username ?>.jpg"
				 style="width: 60px ; height: 60px;object-fit: cover;"
				 class=" rounded-circle img-fluid">
			<?php }else{ ?>
				<div class="my-4"><i class="bi bi-person h1 p-2 border-secondary border rounded-circle" ></i></div>
			<?php } ?>
		</div>
		
	</div>
	<div class="container d-flex flex-column-reverse" style="margin-top: 84px;margin-bottom: 50px">		
		<?php $c=1; ?>
		<?php foreach ($messages as $message) : ?>
			<?php if($message['from_id']==$viewer){$mine=true;}else{$mine=false;} ?>
			<div class="d-flex <?php if ($mine){echo 'justify-content-end my-0';}else{ echo 'my-3';} ?>" id='message<?= $c ?>'>
				<div class="d-flex w-75 <?php if ($mine){echo 'justify-content-end';} ?>">
					<div style="position: relative;">
					<?php if($mine) { ?>
						
						<p class="p-3 rounded" style="background-color: #9ff5ca;">
						<?php if($message['seen']==1){ ?>	
							<i class="bi bi-eye text-muted" style="position: absolute;left: -20px;bottom: 16px"></i>
						<?php } ?>		
					<?php }else{ ?>
						<p class="p-3 rounded border border-light" style="background-color: #e0e0e0">
					<?php } ?>			
							<?= $message['text'] ?>
						</p>
					</div>	
				</div>
			</div>
			<?php $c++ ?>
		<?php endforeach; ?>	

	</div>


	<div style="position: fixed;bottom: 0;right: 0;left: 0" class="d-flex justify-content-center">
		<form class="form-control d-flex" action="." method="get">
			<input class="form-control" type="text" name="new_message" placeholder="Send Message">
			<input type="hidden" name="receiver" value="<?= $contact ?>">
			<input type="hidden" name="action" value='add-message'>
			<button class="btn btn-primary mx-2">Send</button>
		</form>
	</div>

</div>

