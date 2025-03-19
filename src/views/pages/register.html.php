<div class="form_container register">
    <form id="register" action="" method="post">
    
        <h1 class="title">Sign up</h1>
    
        <div class="form_group username">
            <input type="text" id="username" name="username" placeholder="Username" >
            <div class="username_icon">
                <img width="25px" height="25px" src="<?=BASE_URL?>/assets/icons/user.png" alt="">
            </div>
        </div>
    
        <div class="form_group email">
            <input type="email" id="email" name="email" placeholder="Email" >
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

        <div class="form_group confirm_password">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
            <div class="confirm_password_icon">
                <img width="25px" height="25px" src="<?=BASE_URL?>/assets/icons/password.png" alt="">
            </div>
        </div>


        <div class="form_group submit">
            <input type="submit" name="submit" value="Sign up">
        </div>
    
        <div class="form_group register">
            <p>Already have an account? <a href="<?=BASE_URL?>login">Sign in</a></p>
        </div>
    </form>
</div>
