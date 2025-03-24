<section class="home">

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
    
    
    <!-- Post listing here -->
    <div class="posts_container">
        <?php if (isset($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <a href="<?=BASE_URL?>post/<?= $post['post_id'] ?>">
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
                                    <button class="upvote_container" post_id = "<?= $post['post_id'] ?>">
                                        <img id="upvote" src="<?=BASE_URL?>/assets/icons/upvote.png" alt="">
                                        <p class="vote_count">
                                            <?= htmlspecialchars( $post['vote'] )?>
                                        </p>
                                    </button>

                                    <button class="downvote_container" post_id = "<?= $post['post_id'] ?>">
                                        <img id="downvote" src="<?=BASE_URL?>/assets/icons/downvote.png" alt="">
                                    </button>
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
                    </a>
                    
                    <?php if($post['account_id'] === $_SESSION['account_id']): ?>
                        <div class="options_popup hidden">
                            <ul class="options_container">
    
                                <a href="<?= BASE_URL ?>post/<?= $post['post_id']?>/edit">
                                    <li class="item update">
                                        <img src="<?=BASE_URL?>assets/icons/edit.png" alt="">
                                        <p>
                                            Update post
                                        </p>
                                    </li>
                                </a>
                                
    
                                <a href="" id="delete_btn">
                                    <li class="item delete">
                                        <img width="17px" height="17px" src="<?=BASE_URL?>assets/icons/trash.png" alt="">
                                        <p>
                                            Delete post
                                        </p>
                                    </li>
                                </a>
                            </ul>
                        </div>
                        
                    <!-- Post delete confimation -->
                    <?= ViewController::useComponent('deletePostConfirmation', [
                        'modalTitle' => "Delete post?",
                        'modalMessage' => "
                            Are you sure you want to permanently delete this post?
                            This action can not be undone
                        ",
                        'post_id' => $post['post_id'],
                    ]); ?>

                    <?php endif; ?>
                    
                </div>

            <?php endforeach; ?>

        <?php else: ?>
            <h1>Be the first person to post</h1>
        <?php endif; ?>
    </div>
    
</section>