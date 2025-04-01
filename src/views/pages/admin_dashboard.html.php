
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
                <li
                    class="item module"
                >
                    <div class="module_name">
                        Web programming
                    </div>
                    
                    <div class="module_teacher">
                        Mr Tra
                    </div>

                    <div class="module_description">
                        lorem isuapum
                    </div>

                    <div class="module_controls">
                        <!-- <a href="${baseURL}admin/user/edit/${user.account_id}">
                            <img 
                                src="${baseURL}assets/icons/edit.png"  
                                alt=""
                            >
                        </a>

                        <a href="${baseURL}admin/user/delete/${user.account_id}">
                            <img 
                                src="${baseURL}assets/icons/trash.png"  
                                alt=""
                            >
                        </a> -->

                        <a href="<?= BASE_URL ?>admin/module/edit/2">
                            <img 
                                src="<?= BASE_URL ?>assets/icons/edit.png"  
                                alt=""
                            >
                        </a>

                        <a href="<?= BASE_URL ?>admin/module/delete/2">
                            <img 
                                src="<?= BASE_URL ?>assets/icons/trash.png"  
                                alt=""
                            >
                        </a>
                    </div> 
                </li>

            </ul>
        </div>

        <div class="audit_log">
            <h1 class="title">Audit logs</h1>
        </div>
    </div>
</section>