<header>
    <a 
        class="logo"
        href="<?=BASE_URL?>home"
    >
        FORUM
    </a>

    <div class="search_bar">
        <div class="search_icon">
            <img src="<?=BASE_URL?>/assets/icons/search_icon.png" alt="">
        </div>
        <input id="search_input" type="text" placeholder="Search posts or users">
    </div>

    <div class="theme_switcher"></div>

    <div class="profile_container">
        <div class="profile_name">
            username
        </div>
        <a href="<?=BASE_URL?>profile?">
            <div class="profile_avatar">
                <img 
                    width="40px"
                    height="40px"
                    src="https://avatars.githubusercontent.com/u/172468139?v=4" 
                    alt=""
                >
            </div>
        </a>
    </div>
</header>