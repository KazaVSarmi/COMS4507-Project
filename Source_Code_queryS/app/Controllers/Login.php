<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {   
        return view('login');
    }


    public function verify_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $model = model('App\Models\Users');
        $check = $model->login($username, $password);
        $if_remember = $this->request->getPost('remember');
        if ($check) {
            # Create a session 
            $session = session();
            $session->set('username', $username);
            $session->set('password', $password);
            if ($if_remember) {
                # Create a cookie
                setcookie('username', $username, time() + (86400 * 30), "/");
                setcookie('password', $password, time() + (86400 * 30), "/");
            }
            //echo ("hello " . $username . " your password is " . $password);
          
            return redirect()->to(base_url('user_home'));
            
        } else {
            echo "Incorrect credentials or email is not verified";
            echo view('login');
          
        }
    }

// logout redirecting to login
    public function logout()
    {
        helper('cookie');
        $session = session();
        $session->destroy();
        //destroy the cookie
        setcookie('username', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
        return redirect()->to(base_url('login'));
    }

   
}
