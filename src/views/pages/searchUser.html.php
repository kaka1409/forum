<?php if(!empty($users)): ?>
    <div class="search_result_container">
        <div class="search_option_title">
            Related users
        </div>
    
        <div class="user_container">
            <?php foreach($users as $user): ?>
                <a href="<?= BASE_URL ?>profile/<?= $user['account_id']?>">
                    <div class="user">
                        <div class="avatar">
                            <img 
                                src="<?= ROOT_URL . $user['account_avatar'] ?>" 
                                alt=""
                            >
                        </div>

                        <div class="user_details">
                            <div class="username">
                                <p>
                                    <?= $user['account_name']?>
                                </p>
                                <div class="date">
                                    &bull; Joined
                                    <?= 
                                        dateFormat($user['create_at']);
                                    ?>
                                </div>
                            </div>

                            <div class="role <?= $user['role_id'] === 1 ? 'student' : 'admin'?>">
                                <?= $user['role_id'] === 1 ? 'student' : 'admin'?>
                            </div>

                            
                        </div>   
                    </div>
                </a>

            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="search_result_container">
        <div class="search_empty">
            <h1>No users found :/</h1>
            No username matched your search query!!! <br>Let try to search something different
        </div>
    </div>
<?php endif; ?>

