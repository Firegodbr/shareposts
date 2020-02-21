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
    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (user_id, title, body)  VALUES (:user_id, :title, :body)');
        //Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);


        //Execute query
        return $this->db->execute() ? true : false;
    }
    public function updatePost($data)
    {
        $this->db->query('UPDATE posts  SET  title = :title, body = :body WHERE id = :id');
        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);


        //Execute query
        return $this->db->execute() ? true : false;
    }
    public function deletePost($data)
    {
        $this->db->query('DELETE FROM posts  WHERE id = :id');
        //Bind values
        $this->db->bind(':id', $data['id']);


        //Execute query
        return $this->db->execute() ? true : false;
    }
    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}
