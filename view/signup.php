

<div class='container-md mt-5'>
    <div class="row">
        <div class='col-sm-7 container-md mx-md-3'>
                        
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype='multipart/form-data'>
                    <input type="hidden" name="action" value="signing-up"> 
                    
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" name='username' class="form-control" id="username" required>
                    </div>
                
                    <div class="mb-3">
                      <label for="email" class="form-label">E-mail</label>
                      <input type="email" class="form-control" id="email" name='email' required>
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name='password' required>
                    </div>


                    <div class="mb-3">
                      <label for="password2" class="form-label">Confrim Password</label>
                      <input type="password" class="form-control" id="password2" name='password2' required>
                    </div>

                    <div class="mb-3">
                      <label for="formFile" class="form-label">Profile Photo</label>
                      <input class="form-control" type="file" id="formFile" name='avatar'>
                    </div>

                     <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mx-auto">Sign Up</button>
                    </div>

                </form>
                

                <p class='text-danger text-center my-5'><?= $message ?></p>
            
        </div>
        <div class="col-sm-4 mt-sm-5 mx-md-4 d-flex flex-column align-content-center ">
             <div class="d-flex align-self-center">
                    <img src="./view/imgs/logo.png" class="img-fluid mx-auto">
            </div>
            
        </div>
    </div>
   
</div>



