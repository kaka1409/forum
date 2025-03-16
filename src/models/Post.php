<?php

class Post {
    private $db = null;

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

    // public function getId() {
    //     return $this->id;
    // }

    // public function getAuthor() {
    //     return $this->author;
    // }

    // public function getTitle() {
    //     return $this->title;
    // }

    // public function getThumbnail() {
    //     return $this->thumbnail;
    // }

    // public function getContent() {
    //     return $this->content;
    // }

    // public function getModule() {
    //     return $this->module;
    // }

    // public function getDate() {
    //     return $this->date;
    // }


    public static function getAllPosts($db = null) {
        $sql = "SELECT post.title, post.content, post.post_at, post.vote, account.account_name, module.module_name
        FROM `post`
        INNER JOIN `account` ON post.account_id = account.account_id
        INNER JOIN `module` ON post.module_id = module.module_id;";
        $stmt = $db->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }
    
}

?>