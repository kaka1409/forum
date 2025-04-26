<?php

class CommentVoteController {
    public function upvote() {
        global $db;
        $account_id = $_SESSION['account_id'];
        $comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : null;

        if (isset($account_id) && isset($comment_id)) {
            CommentVote::vote($db, $account_id, $comment_id, CommentVote::UPVOTE);
            CommentVote::updateCommentVote($db, $comment_id);
        }
        
        // new vote count
        $voteCount = CommentVote::getVoteCount($db, $comment_id);

        // send data to browser
        sendJson(['voteCount' => $voteCount['votes']]);
    }

    public function downvote() {
        global $db;
        $account_id = $_SESSION['account_id'];
        $comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : null;

        if (isset($account_id) && isset($comment_id)) {
            CommentVote::vote($db, $account_id, $comment_id, CommentVote::DOWNVOTE);
            CommentVote::updateCommentVote($db, $comment_id);
        }

        // new vote count
        $voteCount = CommentVote::getVoteCount($db, $comment_id);

        // send data to browser
        sendJson(['voteCount' => $voteCount['votes']]);
    }
}

?>