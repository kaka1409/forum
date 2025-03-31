
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
                List of user
            </h1>

            <ul class="list">
                <li
                    class="item user"
                >
                    <div class="user_details">
                        <div class="user_avatar">
                            <img 
                                src="<?= ROOT_URL . UPLOAD_FOLDER?>account/default.jpg" 
                                alt=""
                            >
                        </div>

                        <div class="username">
                            user 1
                        </div>
                    </div>

                    <div class="user_role">
                        Admin
                    </div>

                    <div class="user_email">
                        test@gmail.com
                    </div>

                    <div class="user_create_date">
                        created 5 months ago
                    </div>

                    <div class="user_controls">
                        <img 
                            src="<?= BASE_URL ?>assets/icons/edit.png"  
                            alt=""
                        >

                        <img 
                            src="<?= BASE_URL ?>assets/icons/trash.png"  
                            alt=""
                        >
                    </div>

                </li>

            </ul>
        </div>

        <div class="audit_log">
            <h1 class="title">Audit logs</h1>
        </div>
    </div>
</section>