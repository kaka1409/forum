<div class="search_result_container">
    <div class="search_option_title">
        Related posts
    </div>

    <div class="search_posts_container">

        <div class="post">
            <div class="post_header">
                <div class="post_author">
                    <div class="author_thumbnail">
                        <img 
                            src="<?= ROOT_URL ?>uploads/account/kaka1409.png" 
                            alt=""
                        >
                    </div>

                    <div class="author_name_container">
                        <div class="author_name">
                            kk1409
                        </div>
                        <div class="post_date">
                            &bull; 10 months ago
                        </div>
                        <div class="post_module">
                            web programming
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="post_content">

                <div class="post_details_container">
                    <div class="post_title">
                        asdajhsdjhasdjhjhasd
                    </div>

                    <div class="post_controls">
                        <div class="post_vote">
                            <button 
                                class="upvote_container" 
                                post-id="<?= $post['post_id'] ?>"
                            >
                                <img 
                                    id="upvote"  
                                    src="<?=BASE_URL?>assets/icons/upvote.png" 
                                    alt=""
                                >
                                <p class="vote_count">
                                    <!-- <?= htmlspecialchars( $post['vote'] )?> -->
                                     10
                                </p>
                            </button>

                            <button 
                                class="downvote_container" 
                                <!-- post-id="<?= $post['post_id'] ?>" -->
                            >
                                <img 
                                    id="downvote" 
                                    src="<?=BASE_URL?>/assets/icons/downvote.png" 
                                    alt=""
                                >
                            </button>
                        </div>

                        <div class="post_comments">
                            <div class="post_comments_container">
                                <img src="<?= BASE_URL ?>/assets/icons/comment.png" alt="">
                            </div>
                            <p class="comment_count">
                                10

                                <!-- <?= htmlspecialchars( $post['comments_count'] )?> -->
                            </p>
                        </div>

                        <div class="post_save">
                            <!-- <img src="<?=BASE_URL?>/assets/icons/<?= $post['is_bookmarked'] == 1 ? 'saved.png' : 'save.png' ?> " alt=""> -->
                            <img src="<?=BASE_URL?>/assets/icons/save.png" alt="">
                        </div>

                        <div class="post_share">
                            <img src="<?=BASE_URL?>/assets/icons/share.png" alt="">
                        </div>
                    </div>
                </div>
                
                <div class="post_thumbnail">
                    <img
                        src="<?= ROOT_URL ?>uploads/2.jpg" 
                        alt=""
                    >
                </div>

            </div>
        </div>

    
    </div>
</div>