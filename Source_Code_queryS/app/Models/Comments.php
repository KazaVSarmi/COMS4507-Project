<?php

namespace App\Models;

use CodeIgniter\Model;

class Comments_model extends Model
{
    public function add_comment($new_comment_content, $post_id, $user_id)
    {
        $db = \Config\Database::connect();
        $data = [
            'content' => $new_comment_content,
            'post_id' => $post_id,
            'user_id' => $user_id,
            'created_at' => date("Y.m.d h:i:sa")
        ];
        
        $db->table('comments')->insert($data);
    }


    # returns an array of comments within the specified post
    public function get_all_comments_under_post($post_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('comments'); // from comments table
        $builder -> where('post_id',$post_id);
        $query = $builder->get(); // select* and store into query object
        $comments = array();
        foreach ($query->getResult() as $row)
        {
            array_push($comments, $row);
        }
        return $comments;
    }


    # return the timestamp of the comment with the given id
    public function get_timestamp_from_id($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('comments'); // from comments table
        $builder -> where('id',$id);
        $query = $builder->get(); // select* and store into query object
        $row =$query-> getRow();
        if($row)
        {
            return $row->created_at;  
        }
        return NULL;
    }

}