
<div class="row pt-5">

      <div class="col-lg-12">
    
          <?= \Config\Services::validation()->listErrors(); ?>
          <?php if (isset($success_message)) { ?> 
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php } ?>
          <?php if (isset($error_message)) { ?> 
            <div class="alert alert-danger"><?= $error_message ?></div>
          <?php } ?>
          <?php if(isset($orders) && count($orders) != 0): ?>
            <div class="col">
            <table class='table table-bordered table-striped'>
              <thead>
                <?php if(session()->user_type == 'admin'): ?>
                <th>Customer</th>
                <?php endif; ?>
                <th width="15%">Image Proof</th>
                <th>Books</th>
                <th>Total Amount</th>
                <th>Order Status</th>
                <th>Payment Status</th>
                <th>Action</th>
              </thead>
              <tbody>
              <?php foreach ($orders as $order):?>
                <tr>
                  <?php if(session()->user_type == 'admin'): ?>
                  <td>
                  <?php
                    $user = new \App\Models\UsersModel();
                    $user = $user->find($order['user_id']);
                    echo "{$user['first_name']} {$user['last_name']}";
                  ?>
                  </td>
                  <?php endif; ?>
                  <td>

                    <?php if(is_null($order['image_proof'])): ?>
                     <img src="<?= base_url().'jezelbookshop/public/system/payment-proof-default.jpg' ?>" width="100%"  alt="">
                    <?php else: ?>
                    <a href="<?= base_url().'jezelbookshop/public/payments/'.$order['image_proof'] ?>" target="_top">
                     <img src="<?= base_url().'jezelbookshop/public/payments/'.$order['image_proof'] ?>" width="100"  alt="">
                    </a>
                  
                    <?php endif; ?>
                  </td>
                  <td>
                      <?php 
                        $cart_ids = explode(",", $order['carts']);
                        $cartModel = new \App\Models\CartsModel();
                        $carts = $cartModel->find($cart_ids);
                      ?>

                      <ul class="list">
                        <?php foreach ($carts as $cart):?>
                        <?php 
                          $bookModel = new \App\Models\BooksModel();
                          $book = $bookModel->find($cart['book_id']);   
                        ?>
                          <li>
                            <?= $book['title'] ?> (<?= number_format($book['price'], 2  ) ?>)
                            <?php if(session()->user_type == 'customer' && $order['order_status'] == 'confirmed' && $order['payment_status'] == 'paid'): ?>
                              | 
                              <a href="<?= base_url().'jezelbookshop/public/uploads/'.$book['pdf_file'] ?>">Download</a>
                            <?php endif; ?>
                          </li>
                        <?php endforeach;?>
                      </ul>
                    
                  </td>
                  <td>
                  <?= number_format($order['total_amount'], 2) ?>
                  </td>
                  <td><?= ucfirst($order['order_status']) ?></td>
                  <td><?= ucfirst($order['payment_status']) ?></td>
                  <td>
                    <a href="<?= base_url().'jezelbookshop/public/carts/payment/'.$order['id'] ?>">View</a>
                    <?php if(session()->user_type == 'admin' && $order['order_status'] != 'confirmed'): ?>
                      |
                      <a href="<?= base_url().'jezelbookshop/public/orders/approve/'.$order['id'] ?>">Approve</a> 
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach;?>
              </tbody>
              </table>
            </div>
          <?php else: ?>
          <br><br>
          <header class="jumbotron my-4 col-lg-12">
            <h1 class="display-3">You dont have orders yet.</h1>
            <br>
            <a href="<?= base_url().'jezelbookshop/public/books'; ?>" class="btn btn-primary btn-lg">Go Buy Books Now!</a>
          </header>
          <br><br><br><br><br><br><br>
          <?php endif; ?>
      </div>

   
</div>