<?php

namespace App\Controllers;

class New_topic extends BaseController

{
    # creates a field to enter the title of the new topic
    public function new_topic()
    {
        $session = session();
        $logged_in_user = $session->get('username');
        if ($logged_in_user != null) {
            echo "Hello " . $logged_in_user . ",";
            // echo view('dashboard');

            # get list of topics from database and send them to the new_topic.php view
            $model = model('App\Models\Topics');
            $topics_list = $model->get_all_topics();
            $data=['topics_list' => $topics_list];

            echo view('user_home')
                . view('new_topic', $data);
        } else {
            return redirect('login');
        }
    }


    public function add_new_topic()
    {
        # get the title of the new topic
        $new_topic_title = $this->request->getPost('new_topic_title');
        $model = model('App\Models\Topics');
        $model->add_topic($new_topic_title);

        # get list of topics from database and send them to the new_topic.php view
        $row = $model->get_all_topics();
        $data=['topics_list' => $row];


        $session = session();
        $logged_in_user = $session->get('username');
        if ($logged_in_user != null) {
            echo "Hello " . $logged_in_user . ",";
            // echo view('dashboard');
            echo view('user_home')
                . view('new_topic', $data);
        } else {
            return redirect('login');
        }
    }
}
