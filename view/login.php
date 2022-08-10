
<div class="d-flex align-self-center">
    <img src="./view/imgs/logo.png" class="img-fluid mx-auto">
</div>
<div class='container'>
    <form action="." method="get">
        <input type="hidden" name="action" value="login"> 
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name='username' class="form-control" id="username">
        </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name='password'>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class='text-danger text-center my-3'><?= $login_message ?></p>
</div>


