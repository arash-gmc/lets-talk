

<div>
			
		<div class="row my-5 justify-content-center mx-sm-5 mx-2" >
			<div class="container col-md-9 border border-secondary rounded d-flex flex-column p-0 mx-2 my-1" id="post-<?= $post['ID'] ?>">			
				<div class=" d-flex w-100 p-3 rounded" style="background-color: #EAE8E8">
					
						<?php if(file_exists('./view/profile-pictures/'. find_username($post['user-id']) .'.jpg')){ ?>
							<a href=".?action=profile&profile_id=<?= $post['user-id'] ?>"><img src="./view/profile-pictures/<?= find_username($post['user-id']) ?>.jpg" class="img-fluid rounded-circle " style="height: 70px;width: 70px;object-fit: cover;"></a>
						<?php }else{ ?>
							<a href=".?action=profile&profile_id=<?= $post['user-id'] ?>"><div class="my-2"><i class="bi bi-person h3 p-2 my-2 border-secondary border rounded-circle bg-light"></i></div></a>
						<?php } ?>			
						<div class="d-flex flex-column mx-3">
							<h4><strong><?= find_username($post['user-id']) ?></strong></h4>
							<p class="text-muted small"><?= $post['date-time'] ?></p>
						</div>
					</div>
					
				
				<div class="container p-3 border-bottom">
					<p class="lead"><?= $post['post'] ?></p> 
				</div>
				<div class="d-flex justify-content-around container w-75 py-2">
					<a href="#"><img src="./view/imgs/star.svg" style="height: 20px"></a>
					<a href="#"><img src="./view/imgs/forward.svg" style="height: 26px"></a>
					<?php if(!comment_check($_SESSION['user_id'],$post['ID'])){ ?>
						<div class="d-flex">
							<strong class="mx-2"><?= comments_count($post['ID']) ?> </strong>
							<img src="./view/imgs/comment.svg" style="height: 26px;cursor: pointer;" id='comment-<?= $post["ID"] ?>' onclick='show_comments(this)'>
						</div>
					<?php }else{ ?>
						<div class="d-flex">
							<strong class="mx-2"><?= comments_count($post['ID']) ?> </strong>	
							<img src="./view/imgs/commented.svg" style="height: 22px;cursor: pointer;" id='comment-<?= $post["ID"] ?>' onclick='show_comments(this)'>
						</div>
					<?php } ?>	
					<?php if(like_check($_SESSION['user_id'],$post['ID'])) { ?>
						<div>
							<a onclick="show_likers(this)"><strong class="mx-1" style="cursor: pointer;"><?= like_count($post['ID']) ?></strong></a>
							<a href=".?action=unlike&post=<?= $post['ID'] ?>&lastpage=<?= $action ?><?php if($action=='profile'){echo '&profile_id='.$profile_id;}?>"><img src="./view/imgs/liked.svg" style="height: 20px"></a>
						</div>
					<?php }else{ ?>
						<div>
							<a onclick="show_likers(this)"><strong class="mx-1" style="cursor: pointer;"><?= like_count($post['ID']) ?></strong></a>
							<a href=".?action=like&post=<?= $post['ID'] ?>&lastpage=<?= $action ?><?php if($action=='profile'){echo '&profile_id='.$profile_id;} ?>"><img src="./view/imgs/like.svg" style="height: 20px"></a>
						</div>	
					<?php } ?>	
				</div>
				<div class="p-3 d-none flex-column border-top border-bottom" id='likers_box'>
					<h4>Pepole who liked this post:</h4>
					<div class="d-flex flex-column mx-2">
						<?php foreach($likers as $id) : ?>
			      		 	<div class="d-flex border-bottom my-2 align-content-center mx-3">
			      		 		<a href=".?action=profile&profile_id=<?= $id ?>">
				      		 		<div class="mb-2">
				      		 			<?php if(file_exists('./view/profile-pictures/'. find_username($id) .'.jpg')){ ?>
											<img src="./view/profile-pictures/<?= find_username($id) ?>.jpg"
											 style="width: 40px ; height: 40px;object-fit: cover;"
											 class="border rounded-circle img-fluid">
										<?php }else{ ?>
											<div class="my-2"><i class="bi bi-person h4 p-1 border-secondary border rounded-circle" ></i></div>
										<?php } ?>
				      		 		</div>
			      		 		</a>
			      		 		<div class=" w-75 mt-2">
			      		 			<p class="mx-3 lead"><?= find_username($id) ?></p>
			      		 		</div>
			      		 	</div>
					      		 
			      		<?php endforeach; ?>
					</div>
				</div>
				<div class="d-none">
					<div>
						<h4 class="py-3 mx-2 border-bottom">Comments:</h4>
						<?php $comments = get_all_comments($post['ID']);
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
						<textarea rows="3" cols="100" style="resize: none" class="mx-4 p-1 lead" name='post-text'></textarea>
						<div class="d-flex flex-column justify-content-center">
							<button class="btn btn-sm btn-primary">Comment</button>
						</div>
					</form>
				</div>	
			</div>
		</div>

		
</div>