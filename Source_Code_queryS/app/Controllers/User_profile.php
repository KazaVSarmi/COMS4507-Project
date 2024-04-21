<?php

namespace App\Controllers;

class User_profile  extends BaseController

{
    public function view_profile()
    {
        $session = session();
        $username = $session->get('username');
        $model = model('App\Models\Users');
        $row = $model->get_user_details($username);
        
        $data=['username' => $username,
        'email' => $row->email,
        ];

        return view('user_profile',$data);
    }
}