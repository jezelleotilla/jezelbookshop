
<div class="row pt-5">
  <div class="col"></div>
  <div class="col">
    <div class="card">
      <h5 class="card-header">My Profile</h5>
      <div class="card-body">
          <?= \Config\Services::validation()->listErrors(); ?>
          <?php if (isset($success_message)) { ?> 
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php } ?>
          <form action="profile" method="POST" >


              <div class="form-group">
                <label>First Name</label>
                <input required  type="text" name="first_name" value="<?= $user['first_name'] ?> " class="form-control">
              </div>

              <div class="form-group">
                <label>Last Name</label>
                <input required  type="text" name="last_name" value="<?= $user['last_name'] ?> " class="form-control">
              </div>

              <div class="form-group">
                <label>Contact Number</label>
                <input  type="text" name="contact_number" value="<?= $user['contact_number'] ?> " class="form-control">
              </div>

              <div class="form-group">
                <label>Email</label>
                <input  type="email" name="email" value="<?= $user['email'] ?> " class="form-control">
              </div>

              
              <button type="submit" class="btn btn-primary">Update</button>

          </form>
      </div>
    </div>
  </div>
  <div class="col"></div>
</div>