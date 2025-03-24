<?php

class VoteController {
    public function upvote() {
        global $db;
        $account_id = $_SESSION['account_id'];
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : null;

        if (isset($account_id) && isset($post_id)) {
            $result = Vote::vote($db, $account_id, $post_id, Vote::UPVOTE);
        }
        
        // new vote count
        $voteCount = Vote::getVoteCount($db, $post_id);

        $this->sendJson(['voteCount' => $voteCount['votes']]);
    }

    public function downvote() {
        global $db;
        $account_id = $_SESSION['account_id'];
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : null;

        if (isset($account_id) && isset($post_id)) {
            $result = Vote::vote($db, $account_id, $post_id, Vote::DOWNVOTE);
        }

        // new vote count
        $voteCount = Vote::getVoteCount($db, $post_id);

        $this->sendJson(['voteCount' => $voteCount['votes']]);
    }

    private function sendJson($data) {
        header('Content-Type: application/json');
        echo trim(json_encode($data));
        exit;
    }
}

?>