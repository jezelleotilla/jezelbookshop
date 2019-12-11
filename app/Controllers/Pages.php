<?php namespace App\Controllers;

class Pages extends BaseController
{

	public function index($page = 'home')
	{
        
      if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
      {
          // Whoops, we don't have a page for that!
          throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
      }

        
     $session = session();
     if($session->getFlashdata('success_message')){
      $data['success_message'] = $session->getFlashdata('success_message');
     }

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['controller'] = 'pages';
      $data['page'] = $page;


      echo view('templates/header', $data);
      echo view('pages/'.$page, $data);
      echo view('templates/footer', $data);
	}

	//--------------------------------------------------------------------

}
