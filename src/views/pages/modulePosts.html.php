
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

            <div class="feed_options hidden">
                <ul class="options">
                    <li class="option selected">new</li>
                    <li class="option">old</li>
                    <li class="option">top</li>
                    <li class="option">bottom</li>
                </ul>
            </div>
        </div>
    </div>
    
    
    <!-- Post listing here -->
    <div class="posts_container">
        <?php if (!empty($posts_of_module)): ?>
            <?php foreach ($posts_of_module as $post): ?>
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
                                    <?= htmlspecialchars(truncateText($post['title'], 45)) ?>
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
                                    src="<?= ROOT_URL . htmlspecialchars( $post['thumbnail_url'] ); ?>"
                                    alt=""
                                >
                            </div>
                
                            <div class="post_controls">

                                <div class="post_vote">
                                    <button 
                                        class="upvote_container" 
                                        post-id="<?= $post['post_id'] ?>"
                                    >
                                        <img 
                                            id="upvote"  
                                            src="<?=BASE_URL?>assets/icons/<?= $post['is_voted'] == '1' ? 'upvoted.png' : 'upvote.png'; ?>" 
                                            alt=""
                                        >
                                        <p class="vote_count">
                                            <?= htmlspecialchars( $post['vote'] )?>
                                        </p>
                                    </button>

                                    <button 
                                        class="downvote_container" 
                                        post-id="<?= $post['post_id'] ?>"
                                    >
                                        <img 
                                            id="downvote" 
                                            src="<?=BASE_URL?>/assets/icons/<?= $post['is_voted'] == '-1' ? 'downvoted.png' : 'downvote.png'; ?>" 
                                            alt=""
                                        >
                                    </button>
                                </div>
                
                                <div class="post_comments">
                                    <div class="post_comments_container">
                                        <img src="<?= BASE_URL ?>/assets/icons/comment.png" alt="">
                                    </div>
                                    <p class="comment_count">
                                        <?= htmlspecialchars( $post['comments_count'] )?>
                                    </p>
                                </div>
                
                                <div class="post_save">
                                    <img src="<?=BASE_URL?>/assets/icons/<?= $post['is_bookmarked'] == 1 ? 'saved.png' : 'save.png' ?> " alt="">
                                </div>
                                
                                <div class="post_share">
                                    <img src="<?=BASE_URL?>/assets/icons/share.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <?php if(isLoggedIn()): ?>
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
                            
                        <?php endif; ?>
                            
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
            <h1>No posts in this module</h1>
        <?php endif; ?>
    </div>

</section>

    
    
    