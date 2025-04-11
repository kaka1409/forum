<?php if(!empty($posts)): ?>
    <div class="search_result_container">
        <div class="search_option_title">
            Related posts
        </div>

        <div class="search_posts_container">
            <?php foreach($posts as $post): ?>
                <div class="post">
                    <a href="<?=BASE_URL?>post/<?= $post['post_id'] ?>">
                        <div class="post_header">
                            <div class="post_author">
                                <div class="author_thumbnail">
                                    <img 
                                        src="<?= ROOT_URL . $post['account_avatar'] ?>" 
                                        alt=""
                                    >
                                </div>
            
                                <div class="author_name_container">
                                    <div class="author_name">
                                        <?= htmlspecialchars( $post['account_name'] )?>
                                    </div>
                                    <div class="post_date">
                                        &bull; 
                                        <?= 
                                            dateFormat( $post['post_at'] )
                                        ?>
                                    </div>
                                    <div class="post_module">
                                        <?= htmlspecialchars( $post['module_name'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="post_content">
            
                            <div class="post_details_container">
                                <div class="post_title">
                                    <?= 
                                        truncateText(htmlspecialchars( $post['title'] ), 45 )
                                    ?>
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
                            
                            <div class="post_thumbnail">
                                <img
                                    src="<?= ROOT_URL ?><?= $post['thumbnail_url'] == UPLOAD_FOLDER ? 'uploads/default.png' : htmlspecialchars( $post['thumbnail_url'] )?>" 
                                    alt=""
                                >
                            </div>
            
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="search_result_container">
        <div class="search_empty">
            <h1>No post found :/</h1>
            No post title matched your search query!!! <br>Let try to search something different
        </div>
    </div>
<?php endif; ?>


    