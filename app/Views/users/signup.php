
<div class="row pt-5">
  <div class="col"></div>
  <div class="col">
    <div class="card">
      <h5 class="card-header">Signup</h5>
      <div class="card-body">
          <?= \Config\Services::validation()->listErrors(); ?>
          <?php if (isset($success_message)) { ?> 
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php } ?>
          <form action="signup" method="POST" enctype="multipart/form-data" >
            
              <div class="form-group">
                <label>First Name</label>
                <input required  type="text" name="first_name" class="form-control">
              </div>

              <div class="form-group">
                <label>Last Name</label>
                <input required  type="text" name="last_name" class="form-control">
              </div>

              <div class="form-group">
                <label>Username</label>
                <input required  type="text" name="username" class="form-control">
              </div>
              
              <div class="form-group">
                <label>Password</label>
                <input required type="password" name="password" class="form-control">
              </div>

              <div class="form-group">
                <label>Repeat Password</label>
                <input required type="password" name="retype_password" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary">Signup</button>
              <hr>
              <label>Already have an Account? </label>
              <a href="<?= base_url().'jezelbookshop/public/users/login' ?>">Login Now</a>
            
          </form>
      </div>
    </div>
  </div>
  <div class="col"></div>
</div>