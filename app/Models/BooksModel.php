<?php namespace App\Models;
use CodeIgniter\Model;

class BooksModel extends Model
{
    protected $table = 'books';
    protected $allowedFields = ['isbn', 'title', 'short_description', 'publication_date','price', 'pdf_file', 'cover_photo'];
}