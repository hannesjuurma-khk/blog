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
        return $this->db->getAll();
    }

    public function deleteTag($id){
        $this->db->query('DELETE FROM tags WHERE tag_id=:id');
        $this->db->bind(':id', $id);
        $result = $this->db->execute();
        if($result){
            return true;
        }

        return false;
    }

    public function addTag($data){
        $this->db->query('INSERT INTO tags (tag_name, tag_color) VALUES(:tag_name, :tag_color)');
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

    public function getTagById($id){
        $this->db->query('SELECT * FROM tags WHERE tag_id=:id');
        $this->db->bind(':id', $id);
        return $this->db->getOne();
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

    public function getTagPosts($id){
        $this->db->query('SELECT posts.post_id, posts.post_title, posts.post_content, posts.user_id, posts.post_created FROM post_tag, posts WHERE post_tag.post_id = posts.post_id AND post_tag.tag_id=:id');
        $this->db->bind(':id', $id);
        return $this->db->getAll();
    }

}