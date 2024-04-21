<?php

namespace App\Models;

use CodeIgniter\Model;

class Likes_model extends Model
{
    public function add_like_to_comment($comment_id, $user_id)
    {
        $db = \Config\Database::connect();
        $data = [
            'comment_id' => $comment_id,
            'liked_by_user_id' => $user_id,
        ];

        $builder = $db->table('likes'); // from users table
        $builder -> where('comment_id',$comment_id); //where username = session username
        $builder -> where('liked_by_user_id', $user_id);
        $query = $builder->get(); // select* and store into query object
        $row =$query-> getRow();
        if($row) # this user already liked this comment
        {
            $builder->where('id', $row->id);
            $builder->delete();
            return false; 
        }
        # if we reach this point, then the user did not like the comment
        $db->table('likes')->insert($data);
        return true;
    }

    # returns true if comment_id, user_id exists in likes table
    public function get_like_status($comment_id, $user_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('likes'); // from users table
        $builder -> where('comment_id',$comment_id); //where username = session username
        $builder -> where('liked_by_user_id', $user_id);
        $query = $builder->get(); // select* and store into query object
        $row =$query-> getRow();
        if($row) # this user exists in the table
        {
            return true;
        }
        return false;
    }
}