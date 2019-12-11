<br><br>
<header class="jumbotron my-4">
  <h1 class="display-3">Payment Procedure</h1>
  <p class="lead">Your Order has been placed with reference #<?= $order_id ?>. For payment reference, please use your Order Number.</p>
  <p class="lead">
    Here I provided my Bank Account Details for Sending Payment.
  </p>
  <table class="table table-bordered table-striped">
  <tbody>
    <tr>
      <th>Bank Name</th>
      <td>UNIONBANK</td>
    </tr>
    <tr>
      <th>Bank Account Name</th>
      <td>Jezel Leotilla</td>
    </tr>
    <tr>
      <th>Bank Account Number</th>
      <td>10945661825</td>
    </tr>
  </tbody>
  </table>
  
  <p class="lead">
  When payment complete, please take a pic of your proof and upload the image here. And I will verify it within 24 hours business days.
  </p>
  <p class="lead">
  Thank You!, And God Bless Us.
  </p>
  <hr>
  <?= \Config\Services::validation()->listErrors(); ?>
  <?php if (isset($success_message)) { ?> 
    <div class="alert alert-success"><?= $success_message ?></div>
  <?php } ?>

  <?php if (is_null($image_proof)) { ?>
  <form action="<?= base_url().'jezelbookshop/public/payment/upload_proof/'.$order_id ?> " method="POST" enctype="multipart/form-data" >
    <div class="form-group">
      <label>Upload your Proof Of Payment here: </label>
      <input required type="file" name="upload_proof" accept="image/x-png,image/jpg,image/jpeg" >
    </div>
    <button type="submit" class="btn btn-primary ">Submit Payment Proof</button>
  </form/>
  <?php } ?>

  <?php if (!is_null($image_proof) && !isset($success_message)) { ?>
    <?php if ($order_status == 'pending'): ?>
      <div class="alert alert-info">You successfully submitted your payment and the will be verified within 2 to 3 days because of the bank processing standards.</div>
    <?php elseif($order_status == 'confirmed'): ?>
      <div class="alert alert-success">
        Your payment was successfully confirmed. 

      </div>
    <?php elseif($order_status == 'cancelled'): ?>
      <div class="alert alert-danger">
        Your submission was cancelled, please upload again  
        <a href=""></a>
      </div>
    <?php endif; ?>
   
  <?php } ?>
  
</header>
<br><br><br><br><br><br><br>