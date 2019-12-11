<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="<?= base_url().'jezelbookshop/public/vendor/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
  <link href="<?= base_url().'jezelbookshop/public/css/heroic-features.css' ?>" rel="stylesheet">
  <title><?= $title ?></title>
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url().'jezelbookshop/public/'; ?>">JEZEL BOOK SHOP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?= ($controller == 'pages' && $page == 'home') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url().'jezelbookshop/public/'; ?>">HOME
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item <?= ($controller == 'books' && $page == 'books') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url().'jezelbookshop/public/books'; ?>">BOOKS</a>
          </li>
          <?php if(!session()->has('logged_in')): ?>
            <li class="nav-item <?= ($controller == 'users' && $page == 'login') ? 'active' : '' ?>"">
              <a class="nav-link" href="<?= base_url().'jezelbookshop/public/users/login'; ?>">LOGIN</a>
            </li>
          <?php else: ?>

            <?php if(session()->user_type == 'customer'): ?>
              <li class="nav-item  <?= ($controller == 'carts' && $page == 'index') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url().'jezelbookshop/public/carts'; ?>">MY CART</a>
              </li>
              <li class="nav-item  <?= ($controller == 'users' && $page == 'profile') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url().'jezelbookshop/public/users/profile'; ?>">MY PROFILE</a>
              </li>
            <?php else: ?>

            <?php endif; ?>
            <li class="nav-item  <?= ($controller == 'orders' && $page == 'index') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url().'jezelbookshop/public/orders'; ?>"> ORDERS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url().'jezelbookshop/public/users/logout'; ?>">LOGOUT</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">