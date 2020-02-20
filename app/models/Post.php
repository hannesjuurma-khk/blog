<?php


class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts(){
        $this->db->query('SELECT
                            posts.post_id as postId,
                            users.user_id as userId,
                            posts.post_created as postCreated,
                            posts.post_content as postContent
                            FROM posts
                            INNER JOIN users
                            ON posts.user_id = users.user_id
                            ORDER BY posts.post_created DESC');
        return $this->db->getAll();
    }

    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE post_id=:id');
        $this->db->bind(':id', $id);
        return $this->db->getOne();
    }

    public function editPost($data){
        $this->db->query('UPDATE posts SET post_title=:title, post_content=:content WHERE post_id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $result = $this->db->execute();
        if($result){
            return true;
        }

        return false;
    }

    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE post_id=:id');
        $this->db->bind(':id', $id);
        $result = $this->db->execute();
        if($result){
            return true;
        }

        return false;
    }

    public function addPost($data){
        $this->db->query('INSERT INTO posts (post_title, user_id, post_content) VALUES(:title, :user_id, :content)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':content', $data['content']);
        $result = $this->db->execute();
        if($result){
            $this->db->query('SELECT LAST_INSERT_ID() as post_id');
            $result = $this->db->getOne();
            return $result -> post_id;
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

    public function removeAllTag2Post($id){
        $this->db->query('DELETE FROM post_tag WHERE post_id=:post_id');
        $this->db->bind(':post_id', $id);
        $result = $this->db->execute();
        if($result){
            return true;
        }
        return false;
    }

    public function getPostTags($id){
        $this->db->query('SELECT tags.tag_id, tags.tag_name, tags.tag_color FROM post_tag, tags WHERE post_tag.tag_id = tags.tag_id AND post_tag.post_id=:id');
        $this->db->bind(':id', $id);
        return $this->db->getAll();
    }
}