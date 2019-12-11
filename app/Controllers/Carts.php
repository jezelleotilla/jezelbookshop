<?php namespace App\Controllers;

class Carts extends BaseController
{
	public function index($page = 'index'){
    
		if ( ! is_file(APPPATH.'/Views/carts/'.$page.'.php'))
      {
          // Whoops, we don't have a page for that!
          throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
      }

      $cartModel = new \App\Models\CartsModel();
      $carts = $cartModel->where([
        'user_id' => session()->user_id,
        'cart_status' => 'pending'  
      ])->findAll();

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['controller'] = 'carts';
      $data['page'] = $page;
      $data['carts'] = $carts;
      $data['totals'] = 0;
      
     if (count($carts) != 0) {
       $totals = 0;
       foreach ($carts as $cart) {
        $bookModel = new \App\Models\BooksModel();
        $book = $bookModel->find($cart['book_id']);
        $totals += (int)$book['price'];
       }
       $data['totals'] = $totals;
     }

      $session = session();
      if($session->getFlashdata('success_message')){
        $data['success_message'] = $session->getFlashdata('success_message');
      }

      echo view('templates/header', $data);
      echo view('carts/'.$page, $data);
      echo view('templates/footer', $data);
  }
  
  public function create($book_id = 0){
    $cartModel = new \App\Models\CartsModel();
    $bookModel = new \App\Models\BooksModel();

    $cartModel->save([
      'user_id' => session()->user_id,
      'book_id'  =>(int)$book_id,
    ]);

    $book = $bookModel->find($book_id);
    $success_message = $book['title']." is successfully added to your cart.";

    return redirect()->to('/jezelbookshop/public/books')->with('success_message', $success_message);
  }

  public function remove($cart_id){
    $cartModel = new \App\Models\CartsModel();
    $bookModel = new \App\Models\BooksModel();

    $cart = $cartModel->find($cart_id);
    $book = $bookModel->find($cart['book_id']);
    $success_message = $book['title']." has successfully remove from cart.";
    $cartModel->delete($cart_id);
    return redirect()->to('/jezelbookshop/public/carts')->with('success_message', $success_message);
  }

  public function payment($order_id = 0){
    $request_method =  \Config\Services::request()->getMethod();
   
    if ($request_method == 'get' && $order_id != 0) {
     
      $orderModel = new \App\Models\OrdersModel();
      $order = $orderModel->find($order_id);
      
      if(!is_null($order)){
        
        $data['title'] = "Payment Order #".$order_id; // Capitalize the first letter
        $data['controller'] = 'carts';
        $data['page'] = 'payment';
        $data['order_id'] = $order_id;
        $data['image_proof'] = $order['image_proof'];
        $data['order_status'] = $order['order_status'];

        $session = session();
        if($session->getFlashdata('success_message')){
          $data['success_message'] = $session->getFlashdata('success_message');
        }


        echo view('templates/header', $data);
        echo view('carts/payment', $data);
        echo view('templates/footer', $data);

      }else{
        return redirect()->to('/jezelbookshop/public/carts');
      }



    }elseif($request_method == 'post'){
      
      $cartModel = new \App\Models\CartsModel();
      $carts = $cartModel->where([
        'user_id' => session()->user_id,
        'cart_status' => 'pending'
      ])->findAll();
      
      $totals = 0;
      $cart_ids = [];
      if (count($carts) != 0) {
        $totals = 0;
        foreach ($carts as $cart) {
         $bookModel = new \App\Models\BooksModel();
         $book = $bookModel->find($cart['book_id']);
         $cartModel->update($cart['id'], ['cart_status' => 'confirmed']);
         $totals += (int)$book['price'];
         $cart_ids[] = $cart['id'];
        }
      }

      $orderModel = new \App\Models\OrdersModel();
      $order_id = $orderModel->insert([
        'user_id' => session()->user_id,
        'carts' => implode($cart_ids, ','),
        'total_amount'  => $totals
      ]);

      return redirect()->to('/jezelbookshop/public/carts/payment/'.$order_id);  
    }else{
      return redirect()->to('/jezelbookshop/public/carts');
    }
   
  }

  public function upload_proof($order_id = 0){
    $orderModel = new \App\Models\OrdersModel();
    $order = $orderModel->find($order_id);

    $upload_proof_file = $this->request->getFile('upload_proof');
    $upload_proof_file_name = $upload_proof_file->getRandomName();
    if ($upload_proof_file->isValid() && ! $upload_proof_file->hasMoved()){
        $upload_proof_file->move(ROOTPATH.'public/payments', $upload_proof_file_name);
    }

    $orderModel->update($order['id'], ['image_proof' => $upload_proof_file_name]);
    return redirect()->to('/jezelbookshop/public/carts/payment/'.$order_id)->with('success_message', "Your payment voucher has been successfully submitted. Kindly wait within 2 to 3 days for verifying your submission. Thanks!");   
  }

}
