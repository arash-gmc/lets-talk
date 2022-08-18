

<div class='container-md'>
    <div class="row">
        <div class='col-sm-7 container-md'>            
            <div class="d-flex align-self-center">
                <img src="./view/imgs/logo.png" class="img-fluid mx-auto">
            </div>
            <form action="." method="post">
                <input type="hidden" name="action" value="login"> 
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" name='username' class="form-control" id="username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name='password'>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mx-auto">Login</button>
                </div>
            </form>            
            <p class='text-center my-3 <?php if(isset($g)){echo 'text-success';}else{echo 'text-danger';} ?>'><?= $message ?></p>
        </div>
        <div class="col-sm-4 mt-sm-5 mx-md-4 d-flex flex-column align-content-center ">
            <h2 class="my-sm-5 my-3 mx-auto text-nowrap">Don't have an account?</h2>            
            <a class="btn btn-lg btn-primary mx-5" href='.?action=sign-up-page'>Sign Up</a>
            
        </div>
    </div>
    
</div>



