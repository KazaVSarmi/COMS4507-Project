<?php

namespace App\Controllers;

class Posts extends BaseController

{
    public function view_posts()
    {
        
        $session = session();
        $logged_in_user = $session->get('username');
        if ($logged_in_user != null) {
            echo "Hello " . $logged_in_user . ",";
            // echo view('dashboard');

            # get list of topics from database and send them to the new_topic.php view
            $topics_model = model('App\Models\Topics');
            $topics_list = $topics_model->get_all_topics();
            $topics_data=['topics_list' => $topics_list];

            # get the id of the topic whose posts we want to view
            $selected_topic_name = $this->request->getPost('topic_name');
            $selected_topic_id = $this->request->getPost('topic_id');

            # get all posts under the selected id
            $posts_model = model('App\Models\Posts');
            $row = $posts_model->get_all_posts_under_topic($selected_topic_id);
            $posts_data=['posts_list' => $row,
                         'topic_id'=>$selected_topic_id,
                         'topic_name'=>$selected_topic_name];

            echo view('user_home')
                . view('new_topic', $topics_data)
                . view('posts', $posts_data );
        } else {
            return redirect('login');
        }
    }

    


    public function add_new_post()
    {
        # get the heading of the post
        $new_post_heading = $this->request->getPost('new_post_heading');

        # get the topic that this post corresponds to
        $topic_id = $this->request->getPost('topic_id');
        $topic_name = $this->request->getPost('topic_name');
        
        # get the user id
        $session = session();
        $logged_in_user = $session->get('username');
        $user_model = model('App\Models\Users');
        $user_id = $user_model->get_user_id_from_name($logged_in_user);

        # create a new post and add it to the posts table
        $posts_model = model('App\Models\Posts');
        $posts_model->add_post($new_post_heading, $user_id, $topic_id, );

        # get list of posts from database and send them to the posts.php view
        $row = $posts_model->get_all_posts_under_topic($topic_id);
        $posts_data=['posts_list' => $row,
                    'topic_id'=>$topic_id,
                    'topic_name'=>$topic_name];

        # get the list of topics to populate the new_topic.php view
        $topics_model = model('App\Models\Topics');
        $topics_list = $topics_model->get_all_topics();
        $topics_data=['topics_list' => $topics_list];

        if ($logged_in_user != null) {
            echo "Hello " . $logged_in_user . ",";
            // echo view('dashboard');
            echo view('user_home')
                .view('new_topic', $topics_data)
                .view('posts', $posts_data);
        } else {
            return redirect('login');
        }
    }
}