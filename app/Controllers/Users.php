<?php namespace App\Controllers;

class Users extends BaseController
{
	public function login()
	{
    if ( ! is_file(APPPATH.'/Views/users/login.php'))
    {
        // Whoops, we don't have a page for that!
        throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $data['title'] = 'Login'; // Capitalize the first letter
    $data['controller'] = 'users';
    $data['page'] = 'login';

    $session = session();
    if($session->getFlashdata('success_message')){
      $data['success_message'] = $session->getFlashdata('success_message');
    }

    helper('form');
    $userModel = new \App\Models\UsersModel();
    $request_method =  \Config\Services::request()->getMethod();
   
    if($request_method == 'post' && $this->validate([
      'username'  => 'required',
      'password' => 'required'
    ])){
      $username = $this->request->getVar('username');
      $password = $this->request->getVar('password');

      $user = $userModel->where('username', $username)->first();
      if(!is_null($user) && password_verify($password, $user['password'])){
        $newdata = [
                'user_id' => $user['id'],
                'username'  => $username,
                'name'     => $user['first_name']." ".$user['last_name'],
                'user_type' => $user['user_type'],
                'logged_in' => TRUE
        ];
  
        $session->set($newdata);

        return redirect()->to('/jezelbookshop/public/')->with('success_message', "Login Successfully");
      }else{
        $data['error_message'] = "Incorrect username or password";
      }
    }



    echo view('templates/header', $data);
    echo view('users/login', $data);
    echo view('templates/footer', $data);
  }

  public function profile(){
    
    if ( ! is_file(APPPATH.'/Views/users/profile.php'))
    {
        // Whoops, we don't have a page for that!
        throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }
    helper('form');
    $request_method =  \Config\Services::request()->getMethod();
    $userModel = new \App\Models\UsersModel();

    if($request_method == 'post' && $this->validate([
      'first_name' => 'required',
      'last_name' => 'required'
    ])){

      $userModel->update(session()->user_id, [
        'first_name' =>  $this->request->getVar('first_name'),
        'last_name' =>  $this->request->getVar('last_name'),
        'contact_number' =>  $this->request->getVar('contact_number'),
        'email' =>  $this->request->getVar('email')
      ]);
      
      $data['success_message'] = 'Update Successfully';
    }
   
    $user = $userModel->find(session()->user_id);
    $data['title'] = 'My Profile'; // Capitalize the first letter
    $data['controller'] = 'users';
    $data['page'] = 'profile';
    $data['user'] = $user;

    

    echo view('templates/header', $data);
    echo view('users/profile', $data);
    echo view('templates/footer', $data);

  }
  
  public function signup()
	{
    if ( ! is_file(APPPATH.'/Views/users/signup.php'))
    {
        // Whoops, we don't have a page for that!
        throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    helper('form');
    $userModel = new \App\Models\UsersModel();
    $request_method =  \Config\Services::request()->getMethod();
   
    if($request_method == 'post' && $this->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'username'  => 'required|is_unique[users.username]',
      'password' => 'required',
      'retype_password' => 'required|matches[password]'
    ])){

      $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
      // password_verify($password, $hash);
      $userModel->save([
        'first_name' => $this->request->getVar('first_name'),
        'last_name' => $this->request->getVar('last_name'),
        'username' => $this->request->getVar('username'),
        'password'  => $password
      ]);


      return redirect()->to('/jezelbookshop/public/users/login')->with('success_message', "Signup Successfully");

      // $hash = '$2y$10$gORSIMS9bi00N4Q0THo9h.AOmnigAAJ3qFB/qzqvslkEggPEW/o9u';
      // echo password_verify($password, $hash);
      // echo password_hash($password, PASSWORD_DEFAULT);
      // die;

    }

    $data['title'] = 'Signup'; // Capitalize the first letter
    $data['controller'] = 'users';
    $data['page'] = 'signup';

    echo view('templates/header', $data);
    echo view('users/signup', $data);
    echo view('templates/footer', $data);
  }

  public function forgot_password()
	{
    if ( ! is_file(APPPATH.'/Views/users/forgot_password.php'))
    {
        // Whoops, we don't have a page for that!
        throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $data['title'] = 'Forgot Password'; // Capitalize the first letter
    $data['controller'] = 'users';
    $data['page'] = 'forgot_password';

    echo view('templates/header', $data);
    echo view('users/forgot_password', $data);
    echo view('templates/footer', $data);
  }

  public function logout(){
    $session = session();
    $session->remove(['username', 'name', 'user_type', 'logged_in']);
    return redirect()->to('/jezelbookshop/public/')->with('success_message', "Logout Successfully");
  }
  
  


	

}
