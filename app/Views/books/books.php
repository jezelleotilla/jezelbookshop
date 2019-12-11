<div class="row pt-5">
<?php if(session()->has('logged_in') && session()->user_type == 'admin'): ?>
 <div class="col-lg-12">
 <a class="btn btn-primary btn-lg" href="<?= base_url().'jezelbookshop/public/books/create'; ?>">Add New Book</a> 
 </div>
<?php endif; ?>
<?php if(isset($success_message)): ?>
  <div class="col-lg-12">
    <div class="alert alert-success">
      <?= $success_message ?>
    </div>
  </div>  
<?php endif; ?>
<?php if(isset($books)): ?>
  <?php foreach ($books as $book): ?>
  <?php 
     $cartModel = new \App\Models\CartsModel();
     $cart = $cartModel->where([
       'user_id' => session()->user_id,
       'book_id' => $book['id']
     ])->first(); 
  ?>
    <div class="col-lg-3 pt-4">
      <div class="card ">
        <img class="card-img-top" height='200' src="<?= base_url().'jezelbookshop/public/uploads/'.$book['cover_photo'] ?>" />
        <div class="card-body">
          <h4 class="card-title"><?= $book['title'] ?></h4>
         
          <p class="card-text"><?= $book['short_description'] ?></p>
          <p class="card-text">₱<?= number_format($book['price'], 2) ?></p>

          <?php if(session()->has('logged_in') && session()->user_type == 'admin'): ?>
            <?php 
              $admin_cart = $cartModel->where([ 'book_id' => $book['id'] ])->first(); 
            ?>
            <a href="<?= base_url().'jezelbookshop/public/'; ?>books/edit/<?= $book['id'] ?>">Edit</a> 
            <?php if(is_null($admin_cart)): ?>
              | 
              <a href="<?= base_url().'jezelbookshop/public/'; ?>books/delete/<?= $book['id'] ?>">Delete</a>
            <?php else: ?>
             |<strike>Delete</strike> <i><small>Already in the cart</small></i>
            <?php endif; ?>
          <?php else: ?>
            <?php if(is_null($cart)): ?>
              <?php if(session()->has('logged_in')): ?>
                <a  href="<?= base_url().'jezelbookshop/public/'; ?>carts/create/<?= $book['id'] ?>" class="btn btn-primary">Add To Cart</a>
              <?php endif; ?>  
            <?php else: ?>
              <?php if($cart['cart_status'] == 'pending' ): ?>
                <div class="alert alert-warning">
                  Already on your Cart
                </div>
              <?php elseif($cart['cart_status'] == 'confirmed' ): ?>
                <div class="alert alert-info">
                Already Submitted
                </div>
              <?php elseif($cart['cart_status'] == 'completed' ): ?>
                <div class="alert alert-success">
                Paid | <a href="<?= base_url().'jezelbookshop/public/uploads/'.$book['pdf_file'] ?>">Download</a>
                              
                </div>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  <?php endforeach;?>
  <?php endif; ?>
</div>