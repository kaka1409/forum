<?= ViewController::useComponent('backButton')?>

<section id="edit_user_form">
    <form action="<?=BASE_URL?>admin/user/edit/<?= $account['account_id'] ?>" method="POST">
        <h1 class="title">Edit a user</h1>

        <!-- Role -->
        <label for="role">Role: </label>
        <div class="form_group">
            <select name="role">
                <option value="1">Student</option>
                <option value="2">Admin</option>
            </select>
        </div>

        <div class="form_head">
            <!-- accout avatar -->
            <div class="form_group avatar_container">
                <img 
                    class="image_preview avatar"
                    src="<?= ROOT_URL . $account['account_avatar'] ?>" 
                    alt=""
                >
                <input 
                    type="file"     
                    name="account_avatar" 
                    accept="image/*"
                    id=""
                    value=""
                    hidden
                >
            </div>
            
            <div class="user_details">
                <!-- account name -->
                <div class="username_container container">
                    <label for="name">Username: </label>
                    <div class="form_group">    
                        <input 
                            type="text" 
                            name="account_name"
                            placeholder="Enter new username here"
                            value="<?= $account['account_name']?>"
                            autocomplete="off"
                        >
                        
                    </div>
                    <span class="error_message"></span>
                </div>
        
        
                <!-- email -->
                <div class="email_container container">
                    <label for="email">Email: </label>
                    <div class="form_group">
                        <input 
                            type="email" 
                            name="email"
                            placeholder="Enter new email"
                            value="<?= $account['email'] ?>"
                            autocomplete="off"
                        >
                    </div>
                    <span class="error_message"></span>
                </div>
            </div>
    
        </div>



        <!-- new password -->
        <div class="container">
            <label for="password">Password: </label>
            <div class="form_group">
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Enter password"
                    autocomplete="off"
                >
            </div>
            <span class="error_message"></span>
        </div>

        <!-- confirm new password -->
        <div class="container">
            <label for="confirm_password">Confirm password: </label>
            <div class="form_group">
                <input 
                    type="password" 
                    name="confirm_password" 
                    placeholder="Confirm new password"
                    autocomplete="off"
                >
            </div>
            <span class="error_message"></span>
        </div>


        <input type="submit" name="submit" value="Update" id="submit">
    </form>
</section>