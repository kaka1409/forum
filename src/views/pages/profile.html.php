<?php if (isset($_SESSION['account_id'])): ?>
    <!-- Back button -->
    <?= ViewController::useComponent('backButton')?>

    <div class="profile_display_container">
        <div class="profile_name">
            <?= $_SESSION['account_name']?>
        </div>
        <a href="<?=BASE_URL?>profile?">
            <div class="profile_avatar">
                <?php if( $_SESSION['account_avatar'] != null):?>
                    <img 
                        width="40px"
                        height="40px"
                        src="<?=ROOT_URL .  $_SESSION['account_avatar']?>" 
                        alt=""
                    >
                <?php endif; ?>
            </div>
        </a>

        <!-- logout -->
        <div class="logout">
            <a href="<?=BASE_URL?>logout" alt="">log tf out</a>
        </div>
    </div>

<?php else: ?>
    <?php header('Location: ' . BASE_URL . 'login');?>
<?php endif; ?>