<header>
    <a 
        class="logo"
        href="<?=BASE_URL?>home"
    >
        FORUM
    </a>

    <div class="search_bar">
        <div class="search_icon">
            <img src="<?=BASE_URL?>assets/icons/search_icon.png" alt="">
        </div>
        <input id="search_input" type="text" placeholder="Search posts or users">
    </div>

    <div class="theme_switcher"></div>

    <div class="profile_container">
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
                <?php else: ?>
                    <img 
                        width="50px"
                        height="50px"
                        src="<?=BASE_URL?>assets/icons/default_avatar.png" 
                        alt=""
                    >
                <?php endif;?>

            </div>
        </a>
    </div>
</header>