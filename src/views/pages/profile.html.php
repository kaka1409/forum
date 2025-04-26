<?php if (isset($_SESSION['account_id'])): ?>
    <!-- Back button -->
    <?= ViewController::useComponent(name: 'backButton')?>
    
    <section class="profile_display_container">
        <div class="profile_header">
    
            <div class="profile_avatar_container">
                <div class="profile_avatar">
                    <?php if( $account['account_avatar'] != null): ?>
                        <img 
                            src="<?= ROOT_URL .  $account['account_avatar']?> " 
                            alt=""
                        >
                    <?php endif; ?>
                </div>
                <div class="profile_role <?= formatRole($account['role_id'])?>">
                    <?= formatRole($account['role_id']) ?>
                </div>
            </div>
                
            <div class="profile_details">
                <div class="profile_name">
                    <p>
                        Username: 
                    </p>
                    <span>
                        <?= $account['account_name'] ?>
                    </span>
                </div>
                <div class="profile_email">
                    <p>
                        Email: 
                    </p>
                    <span>
                        <?= $account['email'] ?>
                    </span>    
                </div>
            </div>
    
        </div>
    
        <?php if ($account['account_id'] === $_SESSION['account_id']): ?>
            <!-- logout -->
            <div class="logout">
                <a href="<?=BASE_URL?>logout" alt="">Log tf out</a>
            </div>
        
        <?php endif; ?>
    
    </section>

<?php else: ?>
    <?php header('Location: ' . BASE_URL . 'login');?>
<?php endif; ?>

