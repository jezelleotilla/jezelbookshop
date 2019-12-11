<?php namespace App\Controllers;

class Books extends BaseController
{

	public function index($page = 'books')
	{ 

      if ( ! is_file(APPPATH.'/Views/books/'.$page.'.php'))
      {
          // Whoops, we don't have a page for that!
          throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
      }

      $bookModel = new \App\Models\BooksModel();
      $books = $bookModel->findAll();

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['controller'] = 'books';
      $data['page'] = $page;
      $data['books'] = $books;

      $session = session();
      if($session->getFlashdata('success_message')){
        $data['success_message'] = $session->getFlashdata('success_message');
      }

      echo view('templates/header', $data);
      echo view('books/'.$page, $data);
      echo view('templates/footer', $data);
  }

  public function create(){
   
    
    
    helper('form');
    $model = new \App\Models\BooksModel();
    $request_method =  \Config\Services::request()->getMethod();

   
    if( $request_method == 'post' && $this->validate([
        'isbn'  => 'required',
        'title' => 'required|min_length[3]|max_length[255]',
        'short_description' => 'required',
        'publication_date'  => 'required',
        'price'  => 'required'    
      ]) ) {
       
      
      $pdf_file = $this->request->getFile('pdf_file');
      $pdf_file_name = $pdf_file->getRandomName();
      if ($pdf_file->isValid() && ! $pdf_file->hasMoved()){
          $pdf_file->move(ROOTPATH.'public/uploads', $pdf_file_name);
      }

      $cover_photo = $this->request->getFile('cover_photo');
      $cover_photo_file_name = $cover_photo->getRandomName();
      if ($cover_photo->isValid() && ! $cover_photo->hasMoved()){
          $cover_photo->move(ROOTPATH.'public/uploads', $cover_photo_file_name);
      }

      $model->save([
        'isbn' => $this->request->getVar('isbn'),
        'title'  => $this->request->getVar('title'),
        'short_description'  => $this->request->getVar('short_description'),
        'publication_date'  => $this->request->getVar('publication_date'),
        'price'  =>  (int)$this->request->getVar('price'),
        'pdf_file' => $pdf_file_name,
        'cover_photo' => $cover_photo_file_name
      ]);


      $data['success_message'] = $this->request->getVar('title')." is created successfully";
    }

      $data['title'] = 'Create New Book';
      $data['controller'] = 'books';
      $data['page'] = 'create';

      echo view('templates/header', $data);
      echo view('books/create', $data);
      echo view('templates/footer', $data);
  }

  public function edit($book_id){

    helper('form');
    $bookModel = new \App\Models\BooksModel();
    $request_method =  \Config\Services::request()->getMethod();


    
    if( $request_method == 'post' && $this->validate([
      'isbn'  => 'required',
      'title' => 'required|min_length[3]|max_length[255]',
      'short_description' => 'required',
      'publication_date'  => 'required',
      'price'  => 'required'    
    ]) ) {
     
    
 
  

    
    $bookModel->update($book_id, [
      'isbn' => $this->request->getVar('isbn'),
      'title'  => $this->request->getVar('title'),
      'short_description'  => $this->request->getVar('short_description'),
      'publication_date'  => $this->request->getVar('publication_date'),
      'price'  =>  (int)$this->request->getVar('price'),
    ]);

    $cover_photo = $this->request->getFile('cover_photo');
    $cover_photo_file_name = $cover_photo->getRandomName();
    if ($cover_photo->isValid() && ! $cover_photo->hasMoved()){
        $cover_photo->move(ROOTPATH.'public/uploads', $cover_photo_file_name);
        $bookModel->update($book_id, ['cover_photo' => $cover_photo_file_name]);
    }

    $pdf_file = $this->request->getFile('pdf_file');
    $pdf_file_name = $pdf_file->getRandomName();
    if ($pdf_file->isValid() && !$pdf_file->hasMoved()){
        $pdf_file->move(ROOTPATH.'public/uploads', $pdf_file_name);
        $bookModel->update($book_id, ['pdf_file' => $pdf_file_name]);
    }

    $data['success_message'] = $this->request->getVar('title')." updated successfully";
  }
    
    $book = $bookModel->find($book_id);

    $data['title'] = 'Edit Book';
    $data['controller'] = 'books';
    $data['page'] = 'edit';
    $data['book'] = $book;

    echo view('templates/header', $data);
    echo view('books/edit', $data);
    echo view('templates/footer', $data);
  }

  public function delete($book_id){
    $bookModel = new \App\Models\BooksModel();
    $bookModel->delete($book_id);
    return redirect()->to('/jezelbookshop/public/books')->with('success_message', 'Delete Successfully');
  }


	//--------------------------------------------------------------------

}
