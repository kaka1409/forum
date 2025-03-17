<?php
global $db;
$posts = Post::getAllPosts($db);
// print_r($posts[0]);
?>
<!-- Feed setting -->
<section class="home">

    <!-- Feed setting -->
    <div class="feed_settings">
        <div class="feed_text">
            <img
                width="20px"
                height="15px" 
                src="../public/assets/icons/feed_settings.png"
                alt=""
            >
            <p>
                Feed settings
            </p>
        </div>
    </div>
    
    
    <!-- Post listing here -->
    <div class="post_container">
        <?php if (isset($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <div class="post_content">
                        <div class="post_author">
                            <img 
                                width="40px"
                                height="40px"
                                src="https://avatars.githubusercontent.com/u/172468139?v=4" 
                                alt=""
                            >

                            <p class="author_name">
                                <?= htmlspecialchars( $post['account_name'] )?>
                            </p>
                        </div>
            
                        <div class="post_title">
                            <h1>
                                <?= htmlspecialchars( $post['title'] )?>
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
                                src="https://media.daily.dev/image/upload/f_auto,q_auto/v1/posts/6feb3e397ca7338ef21179a7d6c59e35?_a=AQAEuj9" 
                                alt=""
                            >
                        </div>
            
                        <div class="post_options">
                            <div class="post_vote">
                                <img src="../public/assets/icons/upvote.png" alt="">
                                <p class="vote_count">
                                    <?= htmlspecialchars( $post['vote'] )?>
                                </p>
                                <img src="../public/assets/icons/downvote.png" alt="">
                            </div>
            
                            <div class="post_comments">
                                <img src="../public/assets/icons/comment.png" alt="">
                                <p class="comment_count">
                                    <?= htmlspecialchars( $post['comments_count'] )?>
                                </p>
                            </div>
            
                            <div class="post_save">
                                <img src="../public/assets/icons/save.png" alt="">
                            </div>
                            
                            <div class="post_share">
                                <img src="../public/assets/icons/share.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <h1>Be the first person to post</h1>
        <?php endif; ?>
</section>