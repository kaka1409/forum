<!-- Back to home -->
<?= ViewController::useComponent('back_button')?>

<div class="post_container">
    <div class="post_content">

        <!-- author -->
        <div class="post_author">
            <div class="author_avatar">
                <img src="<?= ROOT_URL . $post_content['account_avatar']?>" alt="">
            </div>

            <div class="author_name">
                <?= htmlspecialchars($post_content['account_name'])?>
            </div>

            <div class="post_date">
                &bull; <?= dateFormat( htmlspecialchars($post_content['post_at']))?>
                <?= $post_content['updated_at'] != $post_content['post_at'] ? '(updated ' . dateFormat(htmlspecialchars($post_content['updated_at'])) . ')' : ''?>
            </div>
        </div>

        <!-- title -->
        <div class="title">
            <?= htmlspecialchars($post_content['title'])?>
        </div>

        <!-- thumbnail -->
        <div class="thumbnail">
            <img 
                src=" <?= $post_content['thumbnail_url'] == UPLOAD_FOLDER ? ROOT_URL . 'uploads/default.png' : ROOT_URL . htmlspecialchars( $post_content['thumbnail_url'] ); ?>" 
                alt=""
            >
        </div>

        <!-- content -->
        <div class="content">
            <p>
                <?= htmlspecialchars($post_content['content'])?>
            </p>
        </div>


        <!-- post controls -->
        <div class="post_controls">
            <div class="post_vote">
                <div 
                    class="upvote_container"
                    post-id="<?= $post_content['post_id']?>"
                >
                    <img 
                        id="upvote"     
                        src="<?=BASE_URL?>/assets/icons/<?= $post_content['is_voted'] == '1' ? 'upvoted.png' : 'upvote.png'; ?>"     
                        alt=""
                    >
                    <p class="vote_count">
                        <?= htmlspecialchars( $post_content['vote'] )?>
                    </p>
                </div>

                <div 
                    class="downvote_container"
                    post-id="<?= $post_content['post_id']?>"
                >
                    <img 
                        id="downvote" 
                        src="<?=BASE_URL?>/assets/icons/<?= $post_content['is_voted'] == '-1' ? 'downvoted.png' : 'downvote.png'; ?>" 
                        alt=""
                    >
                </div>
            </div>

            <div class="post_comments">
                <div class="post_comments_container">
                    <img src="<?=BASE_URL?>/assets/icons/comment.png" alt="">
                </div>
                <p class="comment_count">
                    <?= htmlspecialchars( $post_content['comments_count'] )?>
                </p>
            </div>

            <div class="post_save">
                <img src="<?=BASE_URL?>/assets/icons/save.png" alt="">
            </div>
            
            <div class="post_share">
                <img src="<?=BASE_URL?>/assets/icons/share.png" alt="">
            </div>
        </div>

        <!-- comment input -->
        <div class="comment_input">
            <input id="comment" type="text" placeholder="Leave a comment">
            <button id="post_comment" post-id="<?= $post_content['post_id']?>">Post</button>
        </div>

        <!-- comment section -->
        <div class="comment_section">
            <?php if($comments): ?>

                <?php foreach($comments as $comment): ?>
                    <div class="comment">
                        <div class="comment_header">
                            <div class="thumbnail_container">
                                <img src="<?= ROOT_URL . $comment['account_avatar'] ?>" alt="">
                            </div>
        
                            <div class="comment_username">
                                <h1><?= $comment['account_name'] ?></h1>
                                <div class="comment_date">
                                    &bull; <?= dateFormat($comment['commented_at']) ?>
                                </div>
                            </div>
                        </div>    
    
                        <div class="comment_wraper">
                            <div class="branch_line_container"></div>
    
                            <div class="comment_main_container">
                                <div class="comment_content">
                                    <?= $comment['content']?>
                                </div>
                
                                <div class="comment_control">
                                    <div class="comment_vote">
                                        <div class="upvote_container">
                                            <img id="upvote" src="<?=BASE_URL?>/assets/icons/upvote.png" alt="">
                                            <p class="vote_count">
                                                <?= htmlspecialchars( $comment['vote'] )?>
                                            </p>
                                        </div>
                                        <div class="downvote_container">
                                            <img id="downvote" src="<?=BASE_URL?>/assets/icons/downvote.png" alt="">
                                        </div>
                                    </div>
            
                                    <div class="post_comments">
                                        <div class="post_comments_container">
                                            <img src="<?=BASE_URL?>/assets/icons/comment.png" alt="">
                                        </div>
                                    </div>
                                    <!-- <form action="<?= BASE_URL ?>post/reply" method="POST">
                                        <input type="text">
                                        <input id="post_comment" type="submit" name="submit" value="Post">
                                    </form> -->
                                </div>
                            </div>
    
                        </div>
    
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="comment_empty">
                    No comments
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>