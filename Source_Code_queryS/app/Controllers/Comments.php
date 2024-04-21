<?php

namespace App\Controllers;

class Comments extends BaseController

{

    public function add_comment()
    {
        $session = session();
        $logged_in_user = $session->get('username');
        if ($logged_in_user != null) {
            # get the content of the post
            $new_comment_content = $this->request->getPost('new_comment_content');

            # get the post_id and heading under which it has to go
            $post_id = $this->request->getPost('post_id');
            $post_heading = $this->request->getPost('post_heading');

            # get the id of the user who created this post
            $user_model = model('App\Models\Users');
            $user_id = $user_model->get_user_id_from_name($logged_in_user);

            # add the comment to the database
            $comments_model = model('App\Models\Comments');
            $comments_model->add_comment($new_comment_content, $post_id, $user_id);

            # retrieve all the comments under this post and update the view
            $comments_model = model('App\Models\Comments');
            $comments_list = $comments_model->get_all_comments_under_post($post_id);
            $users_list = $this->get_users_from_comments($comments_list);
            $timestamps_list = $this->get_timestamps_from_comments($comments_list);
            $comments_data = [
                'comments_list' => $comments_list,
                'users_list' => $users_list,
                'timestamps_list' => $timestamps_list,
                'post_heading' => $post_heading,
                'post_id' => $post_id
            ];

            echo ('Hello ' . $logged_in_user);
            echo view('comments', $comments_data);
        } else {
            return redirect('login');
        }
    }

    # shows all the comments that are under the post
    public function view_comments()
    {
        $session = session();
        $logged_in_user = $session->get('username');
        
        if ($logged_in_user != null) {

            # get the id of the user who created this post
            $user_model = model('App\Models\Users');
            $user_id = $user_model->get_user_id_from_name($logged_in_user);

            # get the post id
            $post_id = $this->request->getPost('post_id');

            # get post heading
            $post_heading = $this->request->getPost('post_heading');

            # query the comments table for all comments that have the above post_id
            $comments_model = model('App\Models\Comments');
            $comments_list = $comments_model->get_all_comments_under_post($post_id);
            $users_list = $this->get_users_from_comments($comments_list);
            $timestamps_list = $this->get_timestamps_from_comments($comments_list);

            $likes_model = model('App\Models\Likes');
            # check every comment against the logged in user's id to create a list of likes status
            $likes_status_list = array();
            for ($i=0; $i<count($comments_list); $i++)
            {
                array_push($likes_status_list, $likes_model->get_like_status($comments_list[$i]->id, $user_id));   
            }

            $comments_data = [
                'comments_list' => $comments_list,
                'users_list' => $users_list,
                'timestamps_list' => $timestamps_list,
                'post_heading' => $post_heading,
                'post_id' => $post_id,
                'likes_status_list'=> $likes_status_list
            ];

            echo ('Hello ' . $logged_in_user);
            echo view('comments', $comments_data);
        } else {
            return redirect('login');
        }
    }


    # only post heading is given - display comments view with all comments under that post
    public function view_comments_with_post_heading()
    {
        $session = session();
        $logged_in_user = $session->get('username');
        if ($logged_in_user != null) {

            # get the id of the user who created this post
            $user_model = model('App\Models\Users');
            $user_id = $user_model->get_user_id_from_name($logged_in_user);
            
            # get post heading
            $post_heading = $this->request->getPost('query_post_heading');

            # get the id of the post from the heading
            $posts_model = model('App\Models\Posts');
            $post_id = $posts_model->get_id_from_heading($post_heading);

            if (is_null($post_id)) {
                echo ('No match found. Search for another query.');
                echo view('user_home');
            } else {
                # query the comments table for all comments that have the above post_id
                $comments_model = model('App\Models\Comments');
                $comments_list = $comments_model->get_all_comments_under_post($post_id);
                $users_list = $this->get_users_from_comments($comments_list);
                $timestamps_list = $this->get_timestamps_from_comments($comments_list);

                $likes_model = model('App\Models\Likes');
                # check every comment against the logged in user's id to create a list of likes status
                $likes_status_list = array();
                for ($i=0; $i<count($comments_list); $i++)
                {
                    array_push($likes_status_list, $likes_model->get_like_status($comments_list[$i]->id, $user_id));   
                }

                $comments_data = [
                    'comments_list' => $comments_list,
                    'users_list' => $users_list,
                    'timestamps_list' => $timestamps_list,
                    'post_heading' => $post_heading,
                    'post_id' => $post_id,
                    'likes_status_list'=> $likes_status_list
                ];

                echo ('Hello ' . $logged_in_user);
                echo view('comments', $comments_data);
            }
        } else {
            return redirect('login');
        }
    }


    # like the given comment
    public function like_comment()
    {
        $session = session();
        $logged_in_user = $session->get('username');

        if ($logged_in_user != null) {

            # get the id of the logged in user
            $user_model = model('App\Models\Users');
            $user_id = $user_model->get_user_id_from_name($logged_in_user);

            # get the id of the comment
            $comment_id = $this->request->getPost('comment_id');

            # make an entry in the likes table
            $likes_model = model('App\Models\Likes');
            # if user did not like before, add a new entry and return true. 
            # if user already liked the post, delete the entry and $like_status = return false
            $like_status = $likes_model->add_like_to_comment($comment_id, $user_id);


            # get other stuff required to display the comments view
            $post_heading = $this->request->getPost('post_heading');
            $post_id = $this->request->getPost('post_id');

            # query the comments table for all comments that have the above post_id
            $comments_model = model('App\Models\Comments');
            $comments_list = $comments_model->get_all_comments_under_post($post_id);
            $users_list = $this->get_users_from_comments($comments_list);
            $timestamps_list = $this->get_timestamps_from_comments($comments_list);

            # check every comment against the logged in user's id to create a list of likes status
            $likes_status_list = array();
            for ($i=0; $i<count($comments_list); $i++)
            {
                array_push($likes_status_list, $likes_model->get_like_status($comments_list[$i]->id, $user_id));   
            }


            $comments_data = [
                'comments_list' => $comments_list,
                'users_list' => $users_list,
                'timestamps_list' => $timestamps_list,
                'post_heading' => $post_heading,
                'post_id' => $post_id,
                'likes_status_list'=> $likes_status_list
            ];

            echo ('Hello ' . $logged_in_user);
            echo view('comments', $comments_data);
        }else {
            return redirect('login');
        }

    }


    public function get_users_from_comments($comments_list)
    {
        $users_list = array();
        $user_model = model('App\Models\Users');
        foreach ($comments_list as $comment) {
            $user_name = $user_model->get_user_name_from_id($comment->user_id);
            array_push($users_list, $user_name);
        }
        return $users_list;
    }


    public function get_timestamps_from_comments($comments_list)
    {
        $time_list = array();
        $comments_model = model('App\Models\Comments');
        foreach ($comments_list as $comment) {
            $time = $comments_model->get_timestamp_from_id($comment->id);
            array_push($time_list, $time);
        }
        return $time_list;
    }
}
