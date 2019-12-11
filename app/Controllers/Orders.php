<?php namespace App\Controllers;

class Orders extends BaseController
{
	public function index($page = 'index'){
        if ( ! is_file(APPPATH.'/Views/orders/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        
    $session = session();
    if($session->getFlashdata('success_message')){
        $data['success_message'] = $session->getFlashdata('success_message');
    }

    $orderModel = new \App\Models\OrdersModel();
    if(session()->user_type == 'admin'){
        $orders = $orderModel->findAll();
    }else{
        $orders = $orderModel->where('user_id', session()->user_id)->findAll();
    }
    

        $data['title'] = 'Orders'; // Capitalize the first letter
        $data['controller'] = 'orders';
        $data['page'] = $page;
        $data['orders'] = $orders;


        echo view('templates/header', $data);
        echo view('orders/'.$page, $data);
        echo view('templates/footer', $data);
    }
    
    public function approve($order_id){
        
        $orderModel = new \App\Models\OrdersModel();
        $cartModel = new \App\Models\CartsModel();

        $order = $orderModel->find($order_id);
        $orderModel->update($order_id, [
            'order_status' => 'confirmed',
            'payment_status' => 'paid'
        ]);
            
        $carts = explode(",", $order['carts']);
        if(count($carts) != 0){
            foreach ($carts as $cart_id){
                $cartModel->update($cart_id, ['cart_status' => 'completed']); 
            }
        }

        return redirect()->to('/jezelbookshop/public/orders')->with('success_message', 'Order has been successfully approved.');
    }

	//--------------------------------------------------------------------

}
