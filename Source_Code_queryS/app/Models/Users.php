<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    public function login($username, $password)
    { //sql select*from users where users.username=$username and users.password=$password
        //sql select * from users where 
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('is_user_verified',1);
        $query = $builder->get();
        if ($query->getRowArray()) // username exists and user is verified
        { 
            $row = $query->getRow();
            $hashed_password = $row->password;
            $check = password_verify($password,$hashed_password);
            if($check) // password matches hashed password
            {
               
                return true;
                
            } 
            return false; // password does not match hashed password
        } else // username does not exist or user is not verified
        {
            return false;
        }
    }


    public function add_user($username, $password, $email,$verification_key,$is_user_verified)
    {
        $db = \Config\Database::connect();
        $data = [
            'username' => $username,
            'password'  => $password,
            'email'  => $email,
            'verification_key' => $verification_key,
            'is_user_verified' => $is_user_verified
        ];
        
        $db->table('users')->insert($data);
    }


    public function get_user_details($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users'); // from users table
        $builder -> where('username',$username); //where username = session username
        $query = $builder->get(); // select* and store into query object
        $row =$query-> getRow();
        if($row)
        {
            return $row;  
        }
        return NULL;
    }

    # returns the id corresponding to the username
    public function get_user_id_from_name($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users'); // from users table
        $builder -> where('username',$username); //where username = session username
        $query = $builder->get(); // select* and store into query object
        $row =$query-> getRow();
        if($row)
        {
            return $row->id;  
        }
        return NULL;
    }

    # returns the name of the user corresponding to the id
    public function get_user_name_from_id($user_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users'); // from users table
        $builder -> where('id',$user_id); //where id = user_id
        $query = $builder->get(); // select* and store into query object
        $row =$query-> getRow();
        if($row)
        {
            return $row->username;  
        }
        return NULL;
    }


    public function update_user_details($username,$password,$email)
    { // sql = UPDATE username, password, email FROM Users WHERE users.username = session.username

        $db = \Config\Database::connect();
        $builder = $db->table('users'); // from users table
        $builder -> where('username',$username); //where username = session username
        $data = [
            'username' => $username,
            'password'  => $password,
            'email'  => $email,
        ];
        $builder->update($data);
    }


    public function update_verification_key($username,$new_verification_key)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users'); // from users table
        $builder -> where('username',$username); //where username = session username
        $data = [
            'verification_key' => $new_verification_key,
        ];
        $builder->update($data);   
    }


    public function update_new_password($username,$encoded_password)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users'); // from users table
        $builder -> where('username',$username); //where username = session username
        $data = [
            'password' => $encoded_password,
        ];
        $builder->update($data); 
    }


    public function verify_code($email, $verification_key)
    {
        $db = \Config\Database::connect(); 
        $builder = $db->table('users');
        $builder->where('email', $email);
        $builder->where('verification_key', $verification_key);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        } else {
            return false;
        }

    }

    public function verify_code_with_username($username, $verification_key)
    {
        $db = \Config\Database::connect(); 
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('verification_key', $verification_key);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        } else {
            return false;
        }

    }


    public function check_username_email($username,$email)
    {
        $db = \Config\Database::connect(); 
        $builder = $db->table('users');
        $builder->where('email', $email);
        $builder->where('username', $username);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        } else {
            return false;
        }
    }


    
    public function email_verified($email)
    {
        // update is_email_verified from users where db.email=$email
        $db = \Config\Database::connect();
        $builder = $db->table('users'); // from users table
        $builder -> where('email',$email);
        $data = [
            'is_user_verified' => 1,
        ];
        $builder->update($data);
    }
    
}
