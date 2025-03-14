<style>
:root {
    --primary-color: #231B2E;
    --search_bar-color: #393243;
    --post-color: #251B32;
    --border-color: #88518B;
    --main-font: 'Poppins', sans-serif;
    --main-font-color: #fff;
    --secondary-font: 'Secular One', sans-serif;
    --secondary-font-color: #C6ABC8;
}

header {
    position: sticky;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1rem;
    background-color: var(--primary-color);
    color: var(--main-font-color);
    height: 5em;
    border-bottom: 1px solid var(--border-color);
}

/* logo */
.logo {
    margin-left: 1rem;
    font-family: var(--main-font);
    font-size: 3rem;
    font-weight: bold;
    color: var(--main-font-color);
    text-decoration: none;
}
/* logo */

/* Theme switcher */
.theme_switcher {
    display: none;
    width: 6rem;
    height: 3rem;
    border: 0.5px solid var(--border-color);
    border-radius: 1em;
}
/* Theme switcher */

/* Search bar */
.search_bar {
    display: flex;
    align-items: center;
    background-color: var(--search_bar-color);
    border-radius: 1rem;
    width: 30em;
    padding: 0.5rem;
    margin-left: 12rem;
}

.search_icon {
    margin-right: 0.5rem;
    margin-left: 0.5rem;
}

#search_input {
    background-color: transparent;
    border: none;
    outline: none;
    box-shadow: none;
    font-family: var(--secondary-font);
    color: var(--secondary-font-color);
    font-size: 1.2rem;
}

#search_input::placeholder {
    opacity: 50%;
    font-size: 1rem;
    font-family: var(--secondary-font);
    font-weight: bolder;
    color: var(--secondary-font-color);
}
/* Search bar */

/* Profile */
.profile_container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 10em;
}

.profile_name {
    color: var(--secondary-font-color)
}

.profile_avatar{
    width: 40px;
    height: 40px;
    border-radius: 100%;
    border: 0.5px solid var(--border-color);
}
</style>

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