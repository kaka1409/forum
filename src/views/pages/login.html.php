<form action="" method="post">

    <h1 class="title">Login</h1>

    <div class="form_group username">
        <input type="text" id="username" name="username" placeholder="Username">
        <div class="username_icon">
            <img width="25px" height="25px" src="<?=BASE_URL?>/assets/icons/user.png" alt="">
        </div>
    </div>

    <div class="form_group password">
        <input type="password" id="password" name="password" placeholder="Password">
        <div class="password_icon">
            <img width="25px" height="25px" src="<?=BASE_URL?>/assets/icons/password.png" alt="">
        </div>
    </div>

    <div class="form_group forgot_password">
        <a href="#">Forgot password?</a>
    </div>

    <div class="form_group submit">
        <input type="submit" value="Login">
    </div>

    <div class="form_group register">
        <p>Don't have an account? <a href="<?=BASE_URL?>register">Register</a></p>
    </div>
</form>