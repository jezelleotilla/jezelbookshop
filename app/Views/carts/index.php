

<div class="row pt-5">
<?php if(isset($success_message)): ?>
  <div class="col-lg-12">
    <div class="alert alert-success">
      <?= $success_message ?>
    </div>
  </div>  
<?php endif; ?>
<?php if(isset($carts) && count($carts) != 0): ?>
  <div class="col-lg-8">
    <table class='table table-bordered table-striped'>
    <tbody>
    <?php foreach ($carts as $cart):?>
     
      <?php 
        $bookModel = new \App\Models\BooksModel();
        $book = $bookModel->find($cart['book_id']);
      ?>
      <tr>
      <td>
      <div class="row">
        <div class="col-lg-4">
          <img class="card-img-top" height='150' src="<?= base_url().'jezelbookshop/public/uploads/'.$book['cover_photo'] ?>" />
        </div>
        <div class="col-lg-8">
        <h4 class="card-title"><?= $book['title'] ?></h4>
            <p class="card-text"><?= $book['short_description'] ?></p>
            <p class="card-text">₱<?= number_format($book['price'], 2) ?></p>
            <a  href="<?= base_url().'jezelbookshop/public/'; ?>carts/remove/<?= $cart['id'] ?>" class="btn btn-danger">Remove from Cart</a>
        </div>
      </div>
      </td>
      </tr>
    <?php endforeach;?>
    </tbody>
    </table>
  
  </div>
  <div class="col-lg-4">
    <h3>Total Summary</h3>
    <table class="table">
    <thead>
      <tr>
        <th>Book Title</th>
        <th>Book Price</th>
      </tr>
      <tbody>
      <?php foreach ($carts as $cart):?>
        
        <?php 
          $bookModel = new \App\Models\BooksModel();
          $book = $bookModel->find($cart['book_id']);
        ?>
        <tr>
        <td><?= $book['title'] ?></td>
        <td>₱<?= number_format($book['price'], 2) ?></td>
        </tr>
      <?php endforeach;?>
      <tr>
        <th>TOTAL</th>
        <th> ₱<?= number_format($totals, 2) ?></th>
      </tr>
      </tbody>
    </thead>
    </table>
   
    <br>
    <form action="carts/payment" method="POST" >
      <button type="submit" class="btn btn-success btn-lg ">Place Order and Continue To Payment Procedure</button>
    </form/>

    <!-- <a  href="<?= base_url().'jezelbookshop/public/carts/payment'; ?>" class="btn btn-success btn-lg">Place Order and Continue To Payment Procedure</a> -->
  </div>
  <?php else: ?>
    <br><br>
    <header class="jumbotron my-4 col-lg-12">
      <h1 class="display-3">Your Cart is empty</h1>
      <br>
      <a href="<?= base_url().'jezelbookshop/public/books'; ?>" class="btn btn-primary btn-lg">Go Buy Books Now!</a>
    </header>
    <br><br><br><br><br><br><br>
  <?php endif; ?>
</div>

