<?php

namespace App\Controllers;

use Config\Services;

class Signup extends BaseController
{
    public function index()
    {
        if (! $this->request->is('post')) { // if type is not post
            return view('signup');
        }

        // TODO: build these rules
        $rules = ['username' => 'required|is_unique[users.username]',
        'password' => 'required|min_length[10]',
        'passconf' => 'required|matches[password]',
        'email'    => 'required|valid_email',];

        if (! $this->validate($rules)) { // if validation is not successful
            return view('signup');
        }
        else{ // type is post and validation is successful

        // add new user to database
       $model = model('App\Models\Users');
       //get the data from view after user submits
       $username = $this->request->getpost('username');
       $password = $this->request->getpost('password');
       $encoded_password = password_hash($password,PASSWORD_DEFAULT); //ignore error
       $email = $this->request->getpost('email');
       $verification_key = rand(100000,999999); // generate random 6 digit token
       $is_email_verified = 0; // new user defaults to 0 - not verified
       $model->add_user($username, $encoded_password,$email,$verification_key,$is_email_verified);
        
       // send email to user with 6-digit key.
        $this->send_verification_email($email,$verification_key);
       // redirect user to verification page
       $data=[
        'email' => $email
       ];
         return view('email_verification',$data);

        // return to login page
        //return view('login');
        }
        
    }

    // Email verification code
    public function send_verification_email($email,$verification_key)
    {
        $email_service = \Config\Services::email();

        $email_service->setTo($email);
        $email_service->setSubject('Verification email from QueryS');
        $email_service->setMessage('Your verification code is: '.$verification_key);

        $email_service->send();
        echo $email_service->printDebugger();
    }


    public function verify_code()
    {
        $verification_key= $this->request->getPost('verification_key');
        $email= $this->request->getPost('email');
        $model = model('App\Models\Users');
        $check = $model->verify_code($email, $verification_key); // check return value ->true/false
        if ($check)
        {
            // return to login page
            $model->email_verified($email);
            echo "Registration is successful. Please login to proceed.";
            return view('login');
            
        }
        else
        {
            //Incorrect verification key. Please re-enter.
            $data=[
                'email' => $email
               ];
               echo ('Alert: incorrect verification code. Please re-enter');
                return view('email_verification',$data);
        }
    }

}