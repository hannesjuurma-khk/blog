<?php


class Tag
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTags(){
        $this->db->query('SELECT *
                            FROM tags
                            ORDER BY tag_name DESC');
        $tags = $this->db->getAll();
        return $tags;
    }

    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE post_id=:id');
        $this->db->bind(':id', $id);
        $post = $this->db->getOne();
        return $post;
    }

    public function deleteTag($id){
        $this->db->query('DELETE FROM tags WHERE tag_id=:id');
        $this->db->bind(':id', $id);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function addTag($data){
        $this->db->query('INSERT INTO tags (tag_name, tag_color) VALUES(:tag_name, :tag_color)');
//        $this->db->bind(':tag_id', $data['tag_id']);
        $this->db->bind(':tag_name', $data['tag_name']);
        $this->db->bind(':tag_color', $data['tag_color']);
        $result = $this->db->execute();
        if($result){
            $this->db->query('SELECT LAST_INSERT_ID() as tag_id');
            $result = $this->db->getOne();
            return $result -> tag_id;
        }

        return false;
    }

    public function getTagsOld(){
        $this->db->query('SELECT * FROM tags');
        return $this->db->getAll();
    }

    public function getTagById($id){
        $this->db->query('SELECT * FROM tags WHERE tag_id=:id');
        $this->db->bind(':id', $id);
        return $this->db->getOne();
    }

}