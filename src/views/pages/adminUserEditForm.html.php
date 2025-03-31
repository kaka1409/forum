<section id="edit_user_form">
    <form action="<?=BASE_URL?>admin/user/edit/<?= $account['account_id'] ?>" method="POST">
        <!-- Role -->
        <div class="form_group">
            <select name="role">
                <option value="1">Student</option>
                <option value="2">Admin</option>
            </select>
        </div>


        <!-- account name -->
        <div class="form_group">
            <input 
                type="text" 
                name="name"
                placeholder="Enter new username here"
                value="<?= $account['account_name']?>"
                
            >
            <!-- <div class="char_count">
                <p>100</p>
            </div> -->
        </div>


        <!-- email -->
        <div class="form_group">
            <input 
                type="email" 
                name="email"
                placeholder="Enter new email"
                value="<?= $account['email'] ?>"
            >
        </div>

        <!-- accout avatar -->
        <div class="form_group avatar_container">
            <img 
                src="<?= ROOT_URL . $account['account_avatar'] ?>" 
                alt=""
            >
        </div>


        <!-- new password -->
        <div class="form_group">
            <input 
                type="password" 
                name="password" 
                placeholder="Enter password"
            >
        </div>

        <!-- confirm new password -->
        <div class="form_group">
            <input 
                type="password" 
                name="confirm_password" 
                placeholder="Confirm new password"
            >
        </div>

        <input type="submit" name="submit" value="Update" id="submit">
    </form>
</section>