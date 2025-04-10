
<section class="admin_area">
    <div class="admin_controls">
        <div 
            class="control post_control"
            list-type="post"
        >
            <div class="icon_container">
                <img 
                    width="30px"
                    height="30px"
                    src="<?= BASE_URL ?>assets/icons/post.png" 
                    alt=""
                >
            </div>
            <div class="count">
                Total posts/questions
                <p>
                    <?= $post_count[0] ?>
                </p>
            </div>
        </div>

        <div 
            class="control module_control"
            list-type="module"
        >
            <div class="icon_container">
                <img 
                    width="30px"
                    height="30px"
                    src="<?= BASE_URL ?>assets/icons/module.png" 
                    alt=""
                >
            </div>
            <div class="count">
                Total modules
                <p>
                    <?= $module_count[0] ?>
                </p>
            </div>
        </div>

        <div 
            class="control user_control"
            list-type="user"
        >
            <div class="icon_container">
                <img 
                    width="30px"
                    height="30px"
                    src="<?= BASE_URL ?>assets/icons/admin.png" 
                    alt=""
                >
            </div>
            <div class="count">
                Total users
                <p>
                    <?= $user_count[0] ?>
                </p>
            </div>
        </div>

        <div 
            class="control message_control"
            list-type="message"
        >
            <div class="icon_container">
                <img 
                    width="30px"
                    height="30px"
                    src="<?= BASE_URL ?>assets/icons/message.png" 
                    alt=""
                >
            </div>
            <div class="count">
                Total messages
                <p>
                    <?= $message_count[0] ?>
                </p>
            </div>
        </div>
    </div>

    <div class="admin_content">
        <div class="content">
            <h1 class="title">
                List of post
            </h1>

            <ul class="list">
                <?php foreach($posts as $post): ?>
                    <li
                        class="item post"
                    >
    
                        <div class="post_title">
                            <?= htmlspecialchars(
                                    truncateText($post['title'], 20)
                                ) ?>
                        </div>

                        <div class="post_author">
                            by <?= htmlspecialchars($post['account_name']) ?>
                        </div>

                        <div class="posted_date">
                            posted <?= 
                                dateFormat(htmlspecialchars($post['post_at']))
                            ?>
                        </div>

                        <div class="post_controls">
                            <a href="<?= BASE_URL ?>post/<?= $post['post_id']?>/edit">
                                <img src="<?= BASE_URL ?>assets/icons/edit.png" alt="">
                            </a>

                            <form action="<?= BASE_URL ?>post/<?= $post['post_id'] ?>/delete" method="POST">
                                <button style="background-color: transparent; border: none;">
                                    <a href="<?= BASE_URL ?>post/<?= $post['post_id']?>/delete">
                                        <img src="<?= BASE_URL ?>assets/icons/trash.png" alt="">
                                    </a>
                                </button>
                            </form>
                        </div>

                    </li>
                <?php endforeach; ?>
                    
                <a 
                    class="btn add_btn"    
                    href="<?= BASE_URL ?>post/create"
                >
                    + Add
                </a>

            </ul>
        </div>

        <div class="audit_log">
            <h1 class="title">Audit logs</h1>

            <?php if (!empty($logs)): ?>
                <ul class="logs">
                    <?php foreach($logs as $log): ?>
                        
                        <li class="log"> &bull;
                            <span>
                                <?= $_SESSION['account_name'] === $log['admin_name']? 'You' : htmlspecialchars($log['admin_name'])?> 
                            </span>

                            <span class="action <?= htmlspecialchars($log['action'])?>">
                                <?= htmlspecialchars($log['action'])?>
                            </span>

                            <span class="name">
                                <?= htmlspecialchars($log['name'])?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <ul class="log">
                    <li class="log">No audit activity</li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>