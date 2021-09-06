<?php
namespace app\models;
use app\libraries\Model;

class Post extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function findAllPosts() {

        Post::$db->query('SELECT * FROM posts ORDER BY created_at ASC');
        $results = Post::$db->resultSet();

        return $results;
    }
    public function addPost ($data) {
        Post::$db->query('INSERT INTO posts (user_id, title, body) VALUE (:user_id, :title, :body)');
        Post::$db->bind(':user_id', $data['user_id']);
        Post::$db->bind(':title', $data['title']);
        Post::$db->bind(':body', $data['body']);

        if(Post::$db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}