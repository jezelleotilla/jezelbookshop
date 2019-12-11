
<div class="row pt-5">
  <div class="col"></div>
  <div class="col">
    <div class="card">
      <h5 class="card-header">Login</h5>
      <div class="card-body">
          <?= \Config\Services::validation()->listErrors(); ?>
          <?php if (isset($success_message)) { ?> 
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php } ?>
          <?php if (isset($error_message)) { ?> 
            <div class="alert alert-danger"><?= $error_message ?></div>
          <?php } ?>
          <form action="login" method="POST" enctype="multipart/form-data" >
              <div class="form-group">
                <label>Username</label>
                <input required  type="text" name="username" class="form-control">
              </div>
              
              <div class="form-group">
                <label>Password</label>
                <input required type="password" name="password" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary">Login</button>
               | <a href="<?= base_url().'jezelbookshop/public/users/forgot-password' ?>">Forgot Password?</a>
              <hr>
              <label>No account yet? </label>
              <a href="<?= base_url().'jezelbookshop/public/users/signup' ?>">Signup Now</a>
            
          </form>
      </div>
    </div>
  </div>
  <div class="col"></div>
</div>