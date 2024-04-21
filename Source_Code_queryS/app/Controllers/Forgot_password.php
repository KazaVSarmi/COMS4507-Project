<?php

namespace App\Controllers;

class Forgot_password extends BaseController
{
    public function index()
    {
        
        return view ('forgot_password');
    }


    public function request_email()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $model = model('App\Models\Users');
        $check = $model->check_username_email($username, $email);
        if($check) // check is true and username, email exist in database
        {
            //Generate a new verification token
            $new_verification_key = rand(100000,999999);
            //store token in database
            $model->update_verification_key($username,$new_verification_key);
            //send email to user
            $this->send_new_verification_email($email,$new_verification_key);
            //load the same page with new view containing input field to enter verification token
            echo view('forgot_password')
                .view('forgot_password_verify',['username'=>$username]);
        }else{
            echo "Incorrect credentials";
            echo view('forgot_password');
        }
    }


    public function send_new_verification_email($email,$new_verification_key)
    {
        $email_service = \Config\Services::email();

        $email_service->setTo($email);
        $email_service->setSubject('Reset Password');
        $email_service->setMessage('Your verification code to reset your password is: '.$new_verification_key);
        if($email_service->send())
            {
               echo "Email sent"; 
            }else {
                echo "Email not sent";
            }
    
    }


    public function verify_code()
    {
        $username = $this->request->getPost('username');
        $verification_key = $this->request->getPost('verification_key');
        $model = model('App\Models\Users');
        $check=$model->verify_code_with_username($username,$verification_key);
        if($check)
        {
            echo view('forgot_password')
                .view('forgot_password_new_password',['username'=>$username]);
        }else{
            echo "Invalid key";
            echo view('forgot_password');
        }

    }

    public function update_password()
    {
        $username= $this->request->getPost('username');
        $password= $this->request->getPost('password');
        $rules = [
        'password' => 'required|min_length[10]',
        'passconf' => 'required|matches[password]',];

        if (! $this->validate($rules)) { // if validation is not successful
            return view('forgot_password')
                .view('forgot_password_new_password',['username'=>$username]);
        }
        else{ // type is post and validation is successful
        
       $model = model('App\Models\Users');
       //get the data from view after user submits
       $encoded_password = password_hash($password,PASSWORD_DEFAULT); //ignore error
       $model->update_new_password($username,$encoded_password);
       return view ('login');
    }
        
    }
}
