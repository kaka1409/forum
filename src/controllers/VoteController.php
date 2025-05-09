<?php

class VoteController {
    public function upvote() {
        global $db;
        $account_id = $_SESSION['account_id'];
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : null;

        if (isset($account_id) && isset($post_id)) {
            Vote::vote($db, $account_id, $post_id, Vote::UPVOTE);
            Vote::updatePostVote($db, $post_id);
        }
        
        // new vote count
        $voteCount = Vote::getVoteCount($db, $post_id);

        // send data browser
        sendJson(['voteCount' => $voteCount['votes']]);
    }

    public function downvote() {
        global $db;
        $account_id = $_SESSION['account_id'];
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : null;

        if (isset($account_id) && isset($post_id)) {
            Vote::vote($db, $account_id, $post_id, Vote::DOWNVOTE);
            Vote::updatePostVote($db, $post_id);
        }

        // new vote count
        $voteCount = Vote::getVoteCount($db, $post_id);

        // send data browser
        sendJson(['voteCount' => $voteCount['votes']]);
    }

}

?>