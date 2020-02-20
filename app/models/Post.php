<?php

class Post
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getPosts()
    {
        $this->db->query('SELECT *, posts.id as postId, users.id as usersId, posts.created_at as postsCreated, users.created_at as usersCreated FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY posts.created_at DESC');
        $result = $this->db->resultSet();
        return $result;
    }
}
