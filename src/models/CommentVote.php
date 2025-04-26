<?php

class CommentVote {
    const UPVOTE = '1';
    const DOWNVOTE = '-1';

    public static function vote($db, $account_id, $comment_id, $vote_type) { // function called when user vote
        $vote = self::checkVote($db, $account_id, $comment_id); // existing vote

        if ($vote) {

            if ($vote['vote_type'] == $vote_type) { // existing vote has the same vote type user has sent (should toggle off vote btn)
                return self::removeVote($db, $account_id, $comment_id);
            } else { // change vote type
                return self::updateVote($db, $account_id, $comment_id, $vote_type);
            }

        } else { // vote not exist
            return self::createVote($db, $account_id, $comment_id, $vote_type);
        }
    }

    public static function createVote($db, $account_id, $comment_id, $vote_type) { // insert new vote to Vote table
        $sql = "INSERT INTO `commentvote` 
                (`account_id`, `comment_id`, `vote_type`)
                VALUES (:account_id, :comment_id, :vote_type)";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id,
            ':comment_id' => $comment_id,
            ':vote_type' => $vote_type,
        ]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function removeVote($db, $account_id, $comment_id,) { // remove an existing vote 
        $sql = "DELETE FROM `commentvote`
                WHERE account_id = :account_id AND comment_id = :comment_id";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id,
            ':comment_id' => $comment_id,
        ]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function updateVote($db, $account_id, $comment_id, $vote_type) { // change vote type of an existing vote
        $sql = "UPDATE `commentvote`
                SET vote_type = :vote_type
                WHERE account_id = :account_id AND comment_id = :comment_id";

        $stmt = $db->query($sql, [
            ':vote_type' => $vote_type,
            ':account_id' => $account_id,
            ':comment_id' => $comment_id,
        ]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function checkVote($db, $account_id, $comment_id) { // check if the user has already voted 
        $sql = "SELECT * FROM `commentvote`
                WHERE account_id = :account_id AND comment_id = :comment_id";
        
        $stmt = $db->query($sql, [
            ':account_id' => $account_id,
            ':comment_id' => $comment_id,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getVoteCount($db, $comment_id) { // count vote of a comment

        $sql = "SELECT 
                    SUM(CASE WHEN vote_type = '1' THEN 1 ELSE 0 END) as upvotes,
                    SUM(CASE WHEN vote_type = '-1' THEN 1 ELSE 0 END) as downvotes,
                    SUM(CASE WHEN vote_type = '1' THEN 1 ELSE -1 END) as votes
                FROM commentvote 
                WHERE comment_id = :comment_id;";

        $stmt = $db->query($sql, [
            ':comment_id' => $comment_id,
        ]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'upvotes' => $result['upvotes'] ? intval($result['upvotes']) : 0,
            'downvotes' => $result['downvotes'] ? intval($result['downvotes']) : 0,
            'votes' => $result['votes'] ? intval($result['votes']) : 0,
        ];
    }

    public static function updateCommentVote($db, $comment_id) { // update post vote in db
        $voteScore = self::getVoteCount($db, $comment_id);

        $sql = "UPDATE comment
                SET vote = :voteScore
                WHERE comment_id = :comment_id";

        $stmt = $db->query($sql, [
            ':voteScore' => intval($voteScore['votes']),
            ':comment_id' => intval($comment_id)
        ]);

        return $stmt;
    }
}

?>