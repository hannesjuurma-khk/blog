<?php


class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts(){
        $this->db->query('SELECT *,
                            posts.post_id as postId,
                            users.user_id as userId,
                            posts.post_created as postCreated
                            FROM posts
                            INNER JOIN users
                            ON posts.user_id = users.user_id
                            ORDER BY posts.post_created DESC');
        $posts = $this->db->getAll();
        return $posts;
    }

    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE post_id=:id');
        $this->db->bind(':id', $id);
        $post = $this->db->getOne();
        return $post;
    }

    public function editPost($data){
        $this->db->query('UPDATE posts SET post_title=:title, post_content=:content WHERE post_id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE post_id=:id');
        $this->db->bind(':id', $id);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function addPost($data){
        $this->db->query('INSERT INTO posts (post_title, user_id, post_content) VALUES(:title, :user_id, :content)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':content', $data['content']);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function getTags(){
        $this->db->query('SELECT * FROM tags');
        return $this->db->getAll();
    }

    public function getTagsById($id){
        $this->db->query('SELECT * FROM tags WHERE tag_id=:id');
        $this->db->bind(':id', $id);
        return $this->db->getOne();
    }

    public function addTag($data){
        $this->db->query('INSERT INTO tags (tag_name, tag_color) VALUES(:name, :color)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':color', $data['color']);
        $result = $this->db->execute();
        if($result){
            return true;
        }
        return false;
    }

    public function editTag($data){
        $this->db->query('UPDATE tags SET tag_name=:title, tag_color=:content WHERE tag_id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':color', $data['color']);
        $result = $this->db->execute();
        if($result){
            return true;
        }
        return false;
    }

    public function deleteTag($id){
        $this->db->query('DELETE FROM tags as t JOIN post_tag as tp ON t.tag_id = tp.tag_id WHERE t.tag_id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->execute();
        if($result){
            return true;
        }
        return false;
    }

    public function addTag2Post($data){
        $this->db->query('INSERT INTO post_tag (tag_id	, post_id) VALUES(:tag_id, :post_id)');
        $this->db->bind(':tag_id', $data['tag_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $result = $this->db->execute();
        if($result){
            return true;
        }
        return false;
    }

    public function removeTag2Post($data){
        $this->db->query('DELETE FROM post_tag WHERE post_id=:post_id AND tag_id=:tag_id');
        $this->db->bind(':tag_id', $data['tag_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $result = $this->db->execute();
        if($result){
            return true;
        }
        return false;
    }
}