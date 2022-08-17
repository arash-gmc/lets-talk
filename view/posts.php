



<div>
	<?php foreach ($posts as $post) : ?>		
		<div class="row my-3 justify-content-center mx-5" >
			<div class="container col-md-7 border border-secondary rounded d-flex flex-column p-0 mx-2 my-1" id="post-<?= $post['ID'] ?>">			
				<div class=" d-flex w-100 ps-3 pt-2 rounded " style="background-color: #EAE8E8">
					<?php if(file_exists('./view/profile-pictures/'. $post['username'] .'.jpg')){ ?>
						<a href=".?action=profile&profile_id=<?= $post['user-id'] ?>"><img src="./view/profile-pictures/<?= $post['username'] ?>.jpg" class="img-fluid rounded-circle " style="height: 50px;width: 50px;object-fit: cover;"></a>
					<?php }else{ ?>
						<a href=".?action=profile&profile_id=<?= $post['user-id'] ?>"><div class="my-2"><i class="bi bi-person h3 p-2 my-2 border-secondary border rounded-circle bg-light"></i></div></a>
					<?php } ?>			
					<div class="d-flex flex-column mx-3">
						<strong><?= $post['username'] ?></strong>
						<p class="text-muted small"><?= $post['date-time'] ?></p>
					</div>
				</div>
				<div style="height: 90px" class="container p-3 border-bottom">
					<p class="lead"><?= $post['post'] ?></p> 
				</div>
				<div class="d-flex justify-content-around container w-75 py-2">
					<a href="#"><img src="./view/imgs/star.svg" style="height: 20px"></a>
					<a href="#"><img src="./view/imgs/forward.svg" style="height: 26px"></a>
					<?php if(!comment_check($_SESSION['user_id'],$post['ID'])){ ?>
						<div class="d-flex">
							<span class="mx-2"><?= comments_count($post['ID']) ?> </span>
							<img src="./view/imgs/comment.svg" style="height: 26px;cursor: pointer;" id='comment-<?= $post["ID"] ?>' onclick='test(this)'>
						</div>
					<?php }else{ ?>
						<div class="d-flex">
							<span class="mx-2"><?= comments_count($post['ID']) ?> </span>	
							<img src="./view/imgs/commented.svg" style="height: 22px;cursor: pointer;" id='comment-<?= $post["ID"] ?>' onclick='test(this)'>
						</div>
					<?php } ?>	
					<?php if(like_check($_SESSION['user_id'],$post['ID'])) { ?>
						<div>
							<span class="mx-1"><?= like_count($post['ID']) ?></span>
							<a href=".?action=unlike&post=<?= $post['ID'] ?>&lastpage=<?= $action ?><?php if($action=='profile'){echo '&profile_id='.$profile_id;}?>"><img src="./view/imgs/liked.svg" style="height: 20px"></a>
						</div>
					<?php }else{ ?>
						<div>
							<span class="mx-1"><?= like_count($post['ID']) ?></span>
							<a href=".?action=like&post=<?= $post['ID'] ?>&lastpage=<?= $action ?><?php if($action=='profile'){echo '&profile_id='.$profile_id;} ?>"><img src="./view/imgs/like.svg" style="height: 20px"></a>
						</div>	
					<?php } ?>	
				</div>
				<div class="d-none">
					<div>
						<?php $comments = get_some_comments($post['ID']);
							foreach ($comments as $comment) : ?>
								<div class="d-flex mx-4 my-3 border-bottom">
									<div class="mx-2">
										<?php $comment_writer = find_username($comment['user_id']); ?>
										<?php if(file_exists('./view/profile-pictures/'.$comment_writer.'.jpg')){ ?>
											<a href=".?action=profile&profile_id=<?= $comment['user_id'] ?>"><img src="./view/profile-pictures/<?= $comment_writer ?>.jpg"
											 style="width: 30px ; height: 30px;object-fit: cover;"
											 class="border rounded-circle img-fluid"></a>
										<?php }else{ ?>
											<i class="bi bi-person h1 p-2 border-secondary border rounded-circle"></i>
										<?php } ?>
									</div>
									<div>
										<a href=".?action=profile&profile_id=<?= $comment['user_id'] ?>"><strong ><?= $comment_writer ?>: </strong></a>
										<span><?= $comment['text'] ?> </span>
										<span class="small text-muted">(ON <?=$comment['date_time']?>)</span>

									</div>

									
								</div>
							<?php endforeach; ?>	

							
						
					</div>
					<form class="d-flex p-3 justify-content-around " method="get" action=".">
						<input type="hidden" name="action" value="add_comment">
						<input type="hidden" name="post_id" value="<?= $post['ID'] ?>">
						<input type="hidden" name="lastpage" value="<?= $action ?>">
						<?php if($action=='profile'){ ?>
							<input type="hidden" name="profile_id" value="<?= $profile_id ?>">
						<?php } ?>	
						<textarea rows="1" cols="60" style="resize: none" class="mx-4 p-1 lead" name='post-text'></textarea>
						<button class="btn btn-sm btn-primary my-3">Comment</button>
					</form>
				</div>	
			</div>
		</div>

	<?php endforeach; ?>	
</div>