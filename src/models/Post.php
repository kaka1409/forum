<?php

class Post {
    private $id;
    private $author;
    private $title;
    private $thumbnail;
    private $content;
    private $module;
    private $date;

    public function __construct() {
        // because we are using PDO::FETCH_CLASS in getAllPosts() so the constructor need to be empty
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getThumbnail() {
        return $this->thumbnail;
    }

    public function getContent() {
        return $this->content;
    }

    public function getModule() {
        return $this->module;
    }

    public function getDate() {
        return $this->date;
    }


    public static function getAllPosts($db) {
        $sql = "SELECT * FROM `post`;";
        $stmt = $db->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_CLASS, 'Post');
        return $posts;
    }
    
}

?>