<?php

class CommentController {
    public function comment() {
        global $db;
        $post_id = isset($_POST['postId']) ? intval($_POST['postId']) : null ;
        $content = isset($_POST['content']) ? trim($_POST['content']) : '' ;

        if ($post_id  !== null && $content !== '') {
            Comment::createComment($db, $post_id, $content);
        }

        sendJson([
            'username' => $_SESSION['account_name'],
            'avatar' => $_SESSION['account_avatar'],
            'content' => $content
        ]);

    }

    public function reply() {

    }

    public function edit() {

    }

    public function delete() {

    }
}

?>