<?php namespace App\Models;
use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $allowedFields = ['user_id','carts','image_proof','order_status','payment_status','total_amount'];
}