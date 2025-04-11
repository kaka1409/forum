<header>
    <a 
        class="logo"
        href="<?=BASE_URL?>home"
    >
        FORUM
    </a>

    <div class="search_bar">
        <div class="search_input_container">
            <div class="search_icon">
                <img src="<?=BASE_URL?>assets/icons/search_icon.png" alt="">
            </div>
            <input 
                id="search_input" 
                type="text" 
                placeholder="Search posts or users"
                autocomplete="off"    
            >
        </div>
        <div class="search_option"></div>

        <div class="reset_search">
            x
        </div>
    </div>

    <div class="theme_switcher"></div>

    <div class="profile_container">
        <div class="profile_name">
            <?php if (isset($_SESSION['account_name'])): ?>
                <?= $_SESSION['account_name'] ?>
            <?php else: ?>
                <a href="<?=BASE_URL?>login">Sign in</a>
            <?php endif; ?>
        </div>
        <?php if (isLoggedIn()): ?>
            <a href="<?=BASE_URL?>profile/<?= $_SESSION['account_id'] ?? 0?>">
                <div class="profile_avatar">
                    <?php if( isset($_SESSION['account_avatar']) ):?>
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
        <?php else: ?>    
            <a href="<?=BASE_URL?>login?>">
                <div class="profile_avatar">
                    <?php if( isset($_SESSION['account_avatar']) ):?>
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
        <?php endif;?>

    </div>
</header>