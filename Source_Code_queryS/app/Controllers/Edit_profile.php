<?php

namespace App\Controllers;

use Twig\Node\IfNode;

class Edit_profile extends BaseController
{
    public function index()
    {
        $session = session();
        $username = $session->get('username');
        $model = model('App\Models\Users');
        $row = $model->get_user_details($username);

        $data = [
            'username' => $username,
            'email' => $row->email,

        ];

        return view('edit_profile', $data);
    }


    public function update()
    {   //fetch updated user data
        $session = session();
        $username = $session->get('username');
        $oldpassword = $this->request->getPost('oldpassword');
        $newpassword = $this->request->getPost('newpassword');
        $passconf = $this->request->getPost('passconf');
        $email = $this->request->getPost('email');
        $contact = $this->request->getPost('contact');

        //fetch old password from database
        $model = model('App\Models\Users');
        $check = $model->login($username, $oldpassword);
        // if ($oldpassword != null && $newpassword != null && $passconf != null)
        if (!$check) {
            echo ('Old password entered is incorrect.');
            $data = [
                'username' => $username,
                'email' => $email,

            ];
            return view('edit_profile', $data);
            //check failed. old password entered is incorrect.
        } else {
            //validate rules for email, new password

            $rules = [

                'newpassword' => 'min_length[10]',
                'passconf' => 'matches[newpassword]',
                'email'    => 'required|valid_email',
            ];
        }


        if (!$this->validate($rules)) { // if validation is not successful
            // echo "oldpassword: " . $this->request->getPost('oldpassword');
            // echo "passconf: " . $this->request->getPost('passconf');
            // echo "newpassword: " . $this->request->getPost('newpassword');

            $model = model('App\Models\Users');
            $row = $model->get_user_details($username);

            $data = [
                'username' => $username,
                'email' => $row->email,
                'password' => $row->password,
            ];
            return view('edit_profile', $data);
        } else { // type is post and validation is successful

            // update user details to database
            $hashed_new_password = password_hash($newpassword,PASSWORD_DEFAULT);
            $model = model('App\Models\Users');
            $model->update_user_details($username, $hashed_new_password, $email);
            //redirect to view_profile
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $newpassword,
            ];
            return view('user_profile', $data);
        }
    }
}
