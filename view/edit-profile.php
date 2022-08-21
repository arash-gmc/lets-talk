

<div class="d-flex justify-content-center my-5">
	<h2>Edit Profile</h2>
</div>



<div class="row d-flex justify-content-center">
	<div class="col-lg-8 col-md-10">
		
		<div class="accordion mx-sm-4 mx-2 my-4" id="accordionExample">
		  <div class="accordion-item">
		    <h2 class="accordion-header" id="headingOne">
		      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
		        Username
		      </button>
		    </h2>
		    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
		      <div class="accordion-body">
		        <form method="POST" action=".">
		        	<div class="d-flex">
			        	<label class="col-form-label" for="new-username">New Username</label>
			        	<input type="text" class="form-control w-25 mx-3" name="new-username">
			        	<input type="submit" value="Apply" class="btn btn-primary" name="submit">
			        	<input type="hidden" name="value-to-update" value="username">
			        	<input type="hidden" name="action" value="update-profile">
		        	</div>
		        </form>
		      </div>
		    </div>
		  </div>
		  <div class="accordion-item">
		    <h2 class="accordion-header" id="headingTwo">
		      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		        Password
		      </button>
		    </h2>
		    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
		      <div class="accordion-body">
		      	<form method="POST" action=".">
		      		<input type="hidden" name="value-to-update" value="password">
		      		<input type="hidden" name="action" value="update-profile">
			       	<div class="row">
			       		<div class="col-lg-3 col-xl-2 col-5 my-2">
			       			<label class="col-form-label">Current Password</label>
			       		</div>
			       		<div class="col-lg-3 col-7 my-2">
			       			<input type="password" name="current-password" class="form-control">
			       		</div>
			       	</div>
			       	<div class="row">
			       		<div class="col-lg-3 col-xl-2 col-5 my-2">
			       			<label class="col-form-label">New Password</label>
			       		</div>
			       		<div class="col-lg-3 col-7 my-2">
			       			<input type="password" name="new-password" class="form-control">
			       		</div>
			       	</div>
			       	<div class="row">
			       		<div class="col-lg-3 col-xl-2 col-5 my-2">
			       			<label class="col-form-label">Confirm Password</label>
			       		</div>
			       		<div class="col-lg-3 col-7 my-2">
			       			<input type="password" name="new-password-2" class="form-control">
			       		</div>
			       		<div class="col-12 my-4 d-flex ">
			       			<button class="btn btn-primary">Apply</button>
			       		</div>
			       	</div>
			    </form>   	
		      </div>
		    </div>
		  </div>
		  <div class="accordion-item">
		    <h2 class="accordion-header" id="headingThree">
		      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		        Profile Picture
		      </button>
		    </h2>
		    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
		      <div class="accordion-body">
		      	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?> " enctype='multipart/form-data'>
			        <div class="d-flex">
			        	<label class="col-form-label" for="avatar">Profile Photo</label>
			        	<input type="file" class="form-control w-25 mx-3" name="avatar">
			        	<input type="submit" value="Apply" class="btn btn-primary" name="submit">
			        	<input type="hidden" name="value-to-update" value="avatar">
			        	<input type="hidden" name="action" value="update-profile">
		        	</div>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>


	</div>
</div>

<div class="d-flex justify-content-center my-4">
	<h4 class="text-center <?php if($result){echo 'text-success';}else{echo 'text-danger';}?>"><?= $message ?></h4>
</div>
