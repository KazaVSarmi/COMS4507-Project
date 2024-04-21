<?php

namespace App\Controllers;

//if ( ! defined(base_url('user_home'))) exit('No direct script access allowed');

class User_home extends BaseController
{
    /*  public function construct()
      {
          //parent::construct();
          $this->no_cache();
      }


      protected function no_cache()
      {
          header('Cache-Control: no-store, no-cache, must-revalidate');
          header('Cache-Control: post-check=0, pre-check=0',false);
          header('Pragma: no-cache'); 
      }
 */

    public function index()
    {
        $session = session();
        $logged_in_user = $session->get('username');
        if ($logged_in_user != null) {
            echo "Hello " . $logged_in_user . ",";
            // echo view('dashboard');

            echo view('user_home');
        } else {
            return redirect('login');
        }
    }


    public function autocomplete()
    {
        $term = $this->request->getVar('term');
        $topics_model = model('App\Models\Topics');
        $names = $topics_model->get_names_similar_to($term);
        return $this->response->setJSON($names);
    }
}
