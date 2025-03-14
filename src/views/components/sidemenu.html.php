<aside class="side_menu">
    <nav>
        <div class="menu_title_container">

            <!-- Menu title -->
            <div class="title">
                Menu
                <div class="icon collapse_icon">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/collapse_icon.png" 
                        alt=""
                    >
                </div>
            </div>

            <!-- New post button -->
            <a 
                class="new_btn"
                href="<?=BASE_URL?>post/create"
            >
                <div class="btn-content">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/add_icon.png" 
                        alt=""
                    >
                    <p class="btn_text">
                        New Post
                    </p>
                </div>
            </a>
        </div>

        <hr>

        <ul class="menu_list">
            <li class="menu_item selected_item">
                <div class="icon">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/home.png" 
                        alt=""
                    >
                </div>
                <a href="<?=BASE_URL?>home">Home</a>
            </li>
            <li class="menu_item">
                <div class="icon">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/module.png" 
                        alt=""
                    >
                </div>
                <a href="#">Module</a>
            </li>
            <li class="menu_item">
                <div class="icon">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/admin.png" 
                        alt=""
                    >
                </div>
                <a href="#">Admin</a>
            </li>
        </ul>

        <hr>

    </nav>
</aside>