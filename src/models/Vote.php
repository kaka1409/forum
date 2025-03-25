<?php

class Vote {
    const UPVOTE = '1';
    const DOWNVOTE = '-1';

    public static function vote($db, $account_id, $post_id, $vote_type) { // function called when user vote
        $vote = self::checkVote($db, $account_id, $post_id); // existing vote

        if ($vote) {

            if ($vote['vote_type'] == $vote_type) { // existing vote has the same vote type user has sent (should toggle off vote btn)
                return self::removeVote($db, $account_id, $post_id);
            } else { // change vote type
                return self::updateVote($db, $account_id, $post_id, $vote_type);
            }

        } else { // vote not exist
            return self::createVote($db, $account_id, $post_id, $vote_type);
        }
        
    }

    public static function createVote($db, $account_id, $post_id, $vote_type) { // insert new vote to Vote table and assign it to a post
        $sql = "INSERT INTO `vote` 
                (`account_id`, `post_id`, `vote_type`)
                VALUES (:account_id, :post_id, :vote_type)";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id,
            ':post_id' => $post_id,
            ':vote_type' => $vote_type,
        ]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function removeVote($db, $account_id, $post_id,) { // remove an existing vote in a post
        $sql = "DELETE FROM `vote`
                WHERE account_id = :account_id AND post_id = :post_id";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id,
            ':post_id' => $post_id,
        ]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function updateVote($db, $account_id, $post_id, $vote_type) { // change vote type of an existing vote
        $sql = "UPDATE `vote`
                SET vote_type = :vote_type
                WHERE account_id = :account_id AND post_id = :post_id";

        $stmt = $db->query($sql, [
            ':vote_type' => $vote_type,
            ':account_id' => $account_id,
            ':post_id' => $post_id,
        ]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function checkVote($db, $account_id, $post_id) { // check if the user has already voted a post
        $sql = "SELECT * FROM `vote`
                WHERE account_id = :account_id AND post_id = :post_id";
        
        $stmt = $db->query($sql, [
            ':account_id' => $account_id,
            ':post_id' => $post_id,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getVoteCount($db, $post_id) { // count vote of a post

        $sql = "SELECT 
                    SUM(CASE WHEN vote_type = '1' THEN 1 ELSE 0 END) as upvotes,
                    SUM(CASE WHEN vote_type = '-1' THEN 1 ELSE 0 END) as downvotes,
                    SUM(CASE WHEN vote_type = '1' THEN 1 ELSE -1 END) as votes
                FROM vote 
                WHERE post_id = :post_id;";

        $stmt = $db->query($sql, [
            ':post_id' => $post_id,
        ]);
        
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC)[0];

        return [
            'upvotes' => $result['upvotes'] ? intval($result['upvotes']) : 0,
            'downvotes' => $result['downvotes'] ? intval($result['downvotes']) : 0,
            'votes' => $result['votes'] ? intval($result['votes']) : 0,
        ];
    }

    public static function updatePostVote($db, $post_id) { // update post vote in db
        $voteScore = self::getVoteCount($db, $post_id);

        $sql = "UPDATE post
                SET vote = :voteScore
                WHERE post_id = :post_id";

        $stmt = $db->query($sql, [
            ':voteScore' => intval($voteScore['votes']),
            ':post_id' => intval($post_id)
        ]);

        return $stmt;
    }

}

?>