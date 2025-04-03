
<section class="module_view_post_container">
    <div class="main_nav_container">
        <!-- Back button -->
        <?= ViewController::useComponent('backButton')?>

    
        <!-- Feed setting -->
        <div class="feed_settings">
            <div class="feed_text">
                <img
                    width="20px"
                    height="15px" 
                    src="<?=BASE_URL?>/assets/icons/feed_settings.png"
                    alt=""
                >
                <p>
                    Feed settings
                </p>
            </div>
        </div>
    </div>
    
    
    <!-- Post listing here -->
    <div class="posts_container">
        <?php if (!empty($posts_of_module)): ?>
            <?php foreach ($posts_of_module as $post): ?>
                <a href="<?= BASE_URL ?>post/<?= $post['post_id'] ?>">
                    <div class="post">
                        <div class="post_content">

                            <div class="post_head">
                                <div class="post_author">
                                    <div class="author_avatar">
                                        <img 
                                            src="<?=ROOT_URL .  $post['account_avatar']?>" 
                                            alt=""
                                        >
                                    </div>
        
                                    <p class="author_name">
                                        <?= htmlspecialchars( $post['account_name'] )?>
                                    </p>
        
                                </div>
        
                                <div class="post_options">
                                    <img src="<?=BASE_URL?>/assets/icons/more.png" alt="">
                                </div>
                            </div>
                            
                            <div class="post_title">
                                <h1>
                                    <?= strlen(htmlspecialchars( $post['title'] )) > 45 ? substr(htmlspecialchars( $post['title'] ), 0, 45) . '...' : htmlspecialchars( $post['title'] ) ?>
                                </h1>
                            </div>
                
                            <div class="post_module">
                                <p>
                                    <?= htmlspecialchars( $post['module_name'] )?>
                                </p>
                            </div>
                
                            <div class="post_date">
                                <p>
                                    <?= htmlspecialchars(dateFormat( $post['post_at'] )); ?>
                                </p>
                            </div>
                
                            <div class="post_thumbnail">
                                <img 
                                    src="
                                        <?=
                                            $post['thumbnail_url'] == UPLOAD_FOLDER ? ROOT_URL . 'uploads/default.png' : ROOT_URL . htmlspecialchars( $post['thumbnail_url'] );
                                        ?>
                                        "
                                    alt=""
                                >
                            </div>
                
                            <div class="post_controls">
                                <div class="post_vote">
                                    <div class="upvote_container">
                                        <img id="upvote" src="<?=BASE_URL?>/assets/icons/upvote.png" alt="">
                                        <p class="vote_count">
                                            <?= htmlspecialchars( $post['vote'] )?>
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
                                    <p class="comment_count">
                                        <?= htmlspecialchars( $post['comments_count'] )?>
                                    </p>
                                </div>
                
                                <div class="post_save">
                                    <img src="<?=BASE_URL?>/assets/icons/save.png" alt="">
                                </div>
                                
                                <div class="post_share">
                                    <img src="<?=BASE_URL?>/assets/icons/share.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

        <?php else: ?>
            <h1>No posts in this module</h1>
        <?php endif; ?>
    </div>

</section>