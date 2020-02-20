<?php

class Pages extends Controller
{
    public function __construct()
    {
        // $this->postModel = $this->model('Post');
    }

    public function index()
    {
        // $posts = $this->postModel->getPosts();

        $data = [
            'title' => 'SharePosts',
            'description' => 'Simple social network built on TraversyMVC'
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About us',
            'description' => 'App to share posts with other users'
        ];
        $this->view('pages/about', $data);
    }
}
