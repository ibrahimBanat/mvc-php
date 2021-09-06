<?php

namespace app\models;

use app\libraries\Model;

class User extends Model
{


    public function register($data)
    {
        User::$db->query('INSERT INTO users (user_name, user_email, password) VALUES(:username, :email, :password)');

        //Bind values
        User::$db->bind(':username', $data['username']);
        User::$db->bind(':email', $data['email']);
        User::$db->bind(':password', $data['password']);

        //Execute function
        if (User::$db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        User::$db->query('SELECT * FROM users WHERE user_name = :username');

        //Bind value
        User::$db->bind(':username', $username);

        $row = User::$db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email)
    {
        //Prepared statement
        User::$db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        User::$db->bind(':email', $email);

        //Check if email is already registered
        if (User::$db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }
}
