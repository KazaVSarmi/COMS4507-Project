<?php

namespace App\Models;

use CodeIgniter\Model;

class Topics_model extends Model
{
    public function add_topic($new_topic_title)
    {
        $db = \Config\Database::connect();
        $data = [
            'name' => $new_topic_title,
            'created_at' => date("Y.m.d h:i:sa")
        ];
        
        $db->table('topics')->insert($data);
    }


    # returns an array of topics
    public function get_all_topics()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('topics'); // from topics table
        $query = $builder->get(); // select* and store into query object
        $topics = array();
        foreach ($query->getResult() as $row)
        {
            array_push($topics, $row);
        }
        return $topics;
    }


    public function get_names_similar_to($query_name)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('posts'); // from topics table
        $builder -> like('heading',$query_name);
        $query = $builder->get();
        $names_list = array();
        foreach ($query->getResult() as $row)
        {
            array_push($names_list, $row->heading);
        }
        return $names_list;
    }

}