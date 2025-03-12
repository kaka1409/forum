<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/styles/reset.css">
    <link rel="stylesheet" href="../public/assets/styles/main.css">
    <title>forum</title>
</head>
<body>
    <!-- HEADER -->
    <header>
        <h1 class="logo">FORUM</h1>

        <div class="search_bar">
            <div class="search_icon">
                <img src="../public/assets/icons/search_icon.png" alt="">
            </div>
            <input id="search_input" type="text" placeholder="Search posts or users">
        </div>

        <div class="theme_switcher"></div>

        <div class="profile_container">
            <div class="profile_name">
                username
            </div>
            <div class="profile_avatar">
                <img 
                    width="40px"
                    height="40px"
                    src="https://avatars.githubusercontent.com/u/172468139?v=4" 
                    alt=""
                >
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main class="main_container">

        <!-- SIDEBAR -->
        <aside class="side_menu">
            <nav>
                <div class="menu_title_container">
                    <div class="title">
                        Menu
                        <div class="icon collapse_icon">
                            <img 
                                width="20px"
                                height="20px"
                                src="../public/assets/icons/collapse_icon.png" 
                                alt=""
                            >
                        </div>
                    </div>
                    <button class="btn new_btn">
                        <div class="btn-content">
                            <img 
                                width="20px"
                                height="20px"
                                src="../public/assets/icons/add_icon.png" 
                                alt=""
                            >
                            <p class="btn_text">
                                New Post
                            </p>
                        </div>
                    </button>
                </div>

                <hr>

                <ul class="menu_list">
                    <li class="menu_item selected_item">
                        <div class="icon">
                            <img 
                                width="20px"
                                height="20px"
                                src="../public/assets/icons/home.png" 
                                alt=""
                            >
                        </div>
                        <a href="#">Home</a>
                    </li>
                    <li class="menu_item">
                        <div class="icon">
                            <img 
                                width="20px"
                                height="20px"
                                src="../public/assets/icons/module.png" 
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
                                src="../public/assets/icons/admin.png" 
                                alt=""
                            >
                        </div>
                        <a href="#">Admin</a>
                    </li>
                </ul>

                <hr>

            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main_content">
            <!-- main -->
            
            <!-- Feed setting -->
            <div class="feed_settings">
                <div class="feed_text">
                    <img
                        width="20px"
                        height="15px" 
                        src="../public/assets/icons/feed_settings.png"
                        alt=""
                    >
                    <p>
                        Feed settings
                    </p>
                </div>
            </div>


            <!-- Post listing here -->
            <div class="post_container">
                <!-- <?=$output?> -->
            </div>
        </main>
    </main>

</body>
</html>