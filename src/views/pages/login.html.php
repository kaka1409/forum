<div class="form_container login">
    <form id="login" action="" method="post">
    
        <h1 class="title">Login</h1>
    
        <div class="form_group email">
            <input type="text" id="email" name="email" placeholder="Email">
            <div class="email_icon">
                <img width="25px" height="20px" src="<?=BASE_URL?>/assets/icons/email.png" alt="">
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
            <input type="submit" name="submit" value="Login">
        </div>
    
        <div class="form_group register">
            <p>Don't have an account? <a href="<?=BASE_URL?>register">Register</a></p>
        </div>
    </form>
</div>
