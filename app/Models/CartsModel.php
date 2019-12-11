<?php namespace App\Models;
use CodeIgniter\Model;

class CartsModel extends Model
{
    protected $table = 'carts';
    protected $allowedFields = ['user_id','book_id','cart_status'];
}