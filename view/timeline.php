

<form class='container d-flex mt-5 justify-content-center' method="post" action=".">
	<input type="hidden" name="action" value="post-send">
	<div class="mt-3 d-none d-md-block">
		<?php if(file_exists('./view/profile-pictures/'.$_SESSION['username'].'.jpg')){ ?>
			<img src="./view/profile-pictures/<?= $_SESSION['username'] ?>.jpg"
			 style="width: 90px ; height: 90px;object-fit: cover;"
			 class="border rounded-circle img-fluid">
		<?php }else{ ?>
			<i class="bi bi-person h1 p-2 border-secondary border rounded-circle"></i>
		<?php } ?>	
		<p class="text-muted mt-3 text-center"><?= $_SESSION['username'] ?></p>
	</div>
	<textarea rows="3" style="resize: none;min-width: 320px;height: 160px" class="form-control w-50 mx-md-4 mx-2 p-1 lead" name='post-text'></textarea>
	<button class="btn btn-primary h-25 align-self-center">Post</button>
	
</form>

<div class=" mt-3">
	<ul class="nav nav-tabs mx-5">
	  <li class="nav-item">
	    <a class="nav-link <?php if($action=='timeline'){echo 'active';} ?>" aria-current="page" href=".?action=timeline">All Posts</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link <?php if($action=='following-timeline'){echo 'active';} ?>" href=".?action=following-timeline">Followings</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link <?php if($action=='favourites-timeline'){echo 'active';} ?>" aria-current="page" href=".?action=favourites-timeline">Favourites</a>
	  </li>
	</ul>
</div>


<?php include './view/posts.php' ?>






