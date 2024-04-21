<?php

namespace App\Models;

use CodeIgniter\Model;

class Posts_model extends Model
{
    public function add_post($new_post_heading, $user_id, $topic_id)
    {
        $db = \Config\Database::connect();
        $data = [
            'heading' => $new_post_heading,
            'user_id' => $user_id,
            'topic_id' => $topic_id,
            'created_at' => date("Y.m.d h:i:sa")
        ];
        
        $db->table('posts')->insert($data);
    }


    # returns an array of posts within the specified topic
    public function get_all_posts_under_topic($topic_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('posts'); // from posts table
        $builder -> where('topic_id',$topic_id);
        $query = $builder->get(); // select* and store into query object
        $posts = array();
        foreach ($query->getResult() as $row)
        {
            array_push($posts, $row);
        }
        return $posts;
    }


    # returns id from heading
    public function get_id_from_heading($post_heading)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('posts'); // from posts table
        $builder -> where('heading',$post_heading); //where heading = post_heading
        $query = $builder->get(); // select* and store into query object
        $row =$query-> getRow();
        if($row)
        {
            return $row->id;  
        }
        return NULL;
    }
}