<?php
class Posts extends Controller
{
    public function __construct()
    {
        if (!isLogged()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = ['posts' => $posts];
        $this->view('posts/index', $data);
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # Process Form
            //Sanitanize string

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter a body text';
            }
            //Check for errors
            if (empty($data['body_err']) && empty($data['title_err'])) {
                if ($this->postModel->addPost($data)) {
                    flash('post_added', 'POST added successfully!', 'alert alert-success text-center mx-auto');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('posts/add', $data);
            }
        } else {

            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];
            $this->view('posts/add', $data);
        }
    }

    public function edit($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # Process Form
            //Sanitanize string

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

            //Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter a body text';
            }
            //Check for errors
            if (empty($data['body_err']) && empty($data['title_err'])) {
                if ($this->postModel->updatePost($data)) {
                    flash('post_added', 'POST Edited successfully!', 'alert alert-success text-center mx-auto');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('posts/edit', $data);
            }
        } else {
            //Check owner
            $post = $this->postModel->getPostById($id);
            //
            if ($_SESSION['user_id'] != $post->user_id) {
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'title_err' => '',
                'body_err' => ''
            ];
            $this->view('posts/edit', $data);
        }
    }
    public function delete($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # Process Form
            //Sanitanize string
            $post = $this->postModel->getPostById($id);
            if ($_SESSION['user_id'] != $post->user_id) {
                redirect('posts');
            }

            $data = [
                'id' => $id
            ];

            //Validate data
            
            //Check for errors
            
            if ($this->postModel->deletePost($data)) {
                flash('post_added', 'POST Deleted successfully!', 'alert alert-success text-center mx-auto');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
           
        } else {
            redirect('post');
        }
    }
    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = ['post' => $post, 'user' => $user];
        $this->view("posts/show", $data);
    }
}
