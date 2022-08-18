<?php
	$unseen_notification = count_unseen_notification($user_id);
	$unseen_messages = check_all_unseen_messages($user_id);
?>	

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    	<img src="view/imgs/s-logo.png" style="height: 40px" class="img-fluid">
    	Let's Talk
	</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href=".?action=timeline">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=".?action=profile&profile_id=<?= $_SESSION['user_id'] ?>">My Profile</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#">Saved Posts</a>
        </li>
        <li class="nav-item" style="position: relative;">
          <a class="nav-link" href=".?action=notifications">Notifications</a>
          <?php if($unseen_notification){ ?>
				<div style="position: absolute;font-size: 12px;background-color: red;top: 0;right: -4px;color: white;border-radius: 9px; text-align: center;width: 18px;height: 18px"><?= $unseen_notification ?></div>
			<?php } ?>
        </li>
        <li class="nav-item" style="position: relative;">
          <a class="nav-link" href=".?action=inbox">Messages</a>
          <?php if($unseen_messages){ ?>
				<div style="position: absolute;font-size: 12px;background-color: red;top: 0;right: -4px;color: white;border-radius: 9px; text-align: center;width: 18px;height: 18px"><?= $unseen_messages ?></div>
			<?php } ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=".?action=logout">Logout</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      
    </div>
  </div>
</nav>