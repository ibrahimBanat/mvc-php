<?php
namespace app\controllers;
use app\libraries\Controller;
use app\models\Post;

class Posts extends Controller {
    public $postModel;


    public function __construct () {
        parent::__construct();
        $this->postModel = new Post();
    }
    public function index() {
        $posts = $this->postModel->findAllPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', [
            'posts' => $posts
        ]);
    }
    public function create() {
        if(!$this->session->isLoggedIn()) {
            header('Location: ' . URLROOT . "/posts");
        }

        $data = [
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => '',
        ];

        if($_SERVER['REQUEST_METHOD'] =='POST') {
            $__POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($__POST['title']),
                'body' => trim($__POST['body']),
                'titleError' => '',
                'bodyError' => '',
            ];
            if(empty($data['title'])) {
                $data['titleError'] = 'The title of the post cannot be empty';

            }
            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of the post cannot be empty';
            }
            if(empty($data['titleError']) && empty($data['bodyError'])) {
                if($this->postModel->addPost($data)) {
                    header('Location: ' . URLROOT . "/posts");
                }else {
                    die('Something went wrong please try again');
                }
            }
        }
        $this->view('posts/create', $data);
    }
    public function update($id) {
        $post = $this->postModel->findPostById($id);


        if(!$this->session->isLoggedIn()) {
            header('Location: ' . URLROOT . '/posts');
        } elseif ($post->user_id !== $_SESSION['user_id']) {

            header('Location: ' . URLROOT . '/posts');

        }
        $data = [
            'id' => $id,
            'post' => $post,
            'title' =>  '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] =='POST') {
        $__POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'user_id' => $_SESSION['user_id'],
            'id' => $id,
            'post' => $post,
            'title' => trim($__POST['title']),
            'body' => trim($__POST['body']),
            'titleError' => '',
            'bodyError' => '',
        ];
        if(empty($data['title'])) {
            $data['titleError'] = 'The title of the post cannot be empty';

        }
        if(empty($data['body'])) {
            $data['bodyError'] = 'The body of the post cannot be empty';
        }
        if($data['title'] == $this->postModel->findPostById($id)->title) {
            $data['titleError'] = 'change at least the blog title!';
        }
        if($data['body'] == $this->postModel->findPostById($id)->body) {
            $data['bodyError'] = 'change at least the blog body!';
        }

        if(empty($data['titleError']) && empty($data['bodyError'])) {
            if($this->postModel->updatePost($data)) {
                header('Location: ' . URLROOT . "/posts");
            }else {
                die('Something went wrong please try again');
            }
        }
    }

        $this->view('posts/update', $data);
    }
    public function delete($id) {
        $post = $this->postModel->findPostById($id);

        if(!$this->session->isLoggedIn()) {
            header("Location: " . URLROOT . "/posts");
        } elseif($post->user_id !== $_SESSION['user_id']){
            header("Location: " . URLROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->postModel->deletePost($id)) {
                header("Location: " . URLROOT . "/posts");
            } else {
                die('Something went wrong!');
            }
        }
    }

}