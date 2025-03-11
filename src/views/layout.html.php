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

                
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main_content">
            <!-- Post listing here -->
             main
        </main>
    </main>

</body>
</html>