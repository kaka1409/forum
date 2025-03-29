<aside class="side_menu">
    <nav>
        <div class="menu_title_container">

            <!-- Menu title -->
            <div class="title">
                <p class="title_text">Menu</p>
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
            <a 
                class="menu_item <?= stripos($_SERVER['REQUEST_URI'], BASE_URL . 'home') !== false ? 'selected_item' : '';?>"
                href="<?=BASE_URL?>home"    
            >
                <div class="icon">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/home.png" 
                        alt=""
                    >
                </div>
                <p class="menu_item_text">Home</p>
            </a>

            <a 
                class="menu_item <?= stripos($_SERVER['REQUEST_URI'], BASE_URL . 'module') !== false ? 'selected_item' : '';?>"
                href="<?=BASE_URL?>module"    
            >
                <div class="icon">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/module.png" 
                        alt=""
                    >
                </div>
                <p class="menu_item_text">Module</p>
            </a>

            <?php if(isAdmin()): ?>
                <a 
                    class="menu_item <?= stripos($_SERVER['REQUEST_URI'], BASE_URL . 'admin') !== false ? 'selected_item' : '';?>"
                    href="<?=BASE_URL?>admin"    
                >
                    <div class="icon">
                        <img 
                            width="20px"
                            height="20px"
                            src="<?=BASE_URL?>assets/icons/admin.png" 
                            alt=""
                        >
                    </div>
                    <p class="menu_item_text">Admin</p>
                </a>           
            <?php else: ?>            
                <a 
                    class="menu_item <?= stripos($_SERVER['REQUEST_URI'], BASE_URL . 'email') !== false ? 'selected_item' : '';?>"
                    href="<?=BASE_URL?>email"    
                >
                    <div class="icon">
                        <img 
                            width="20px"
                            height="20px"
                            src="<?=BASE_URL?>assets/icons/admin.png" 
                            alt=""
                        >
                    </div>
                    <p class="menu_item_text">Contact</p>
                </a>
            <?php endif; ?>

            <a 
                class="menu_item <?= stripos($_SERVER['REQUEST_URI'], BASE_URL . 'bookmarks') !== false ? 'selected_item' : '';?>"
                href="<?=BASE_URL?>bookmarks"    
            >
                <div class="icon">
                    <img 
                        width="20px"
                        height="20px"
                        src="<?=BASE_URL?>assets/icons/bookmark.png" 
                        alt=""
                    >
                </div>
                <p class="menu_item_text">Bookmarks</p>
            </a>

        </ul>

        <hr>

    </nav>
</aside>