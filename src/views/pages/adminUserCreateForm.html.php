<?= ViewController::useComponent('backButton')?>

<section id="create_user_form">
    <form action="" method="POST">
        <h1 class="title">Create a new user account</h1>

        <label for="role">Role: </label>
        <div class="form_group role">
            <select name="role">
                <option value="1">Student</option>
                <option value="2">Admin</option>
            </select>
        </div>

        <div class="form_head">
            <div class="avatar_container">
                <div class="avatar_placeholder">
                    <img 
                        width="15px"
                        height="15px"
                        src="<?= BASE_URL ?>assets/icons/thumbnail.png" 
                        alt=""
                        >
                    <p>Select image</p>
                </div>

                <input 
                    type="file"
                    name="account_avatar" 
                    hidden
                >

                <img 
                    src=""  
                    alt=""
                    class="avatar_preview"
                >
                
            </div>

            <div class="user_details">
                <div class="username_container">
                    <label for="account_name">Username: </label>
                    <div class="form_group username">
                        <input 
                            type="text" 
                            name="account_name" 
                            placeholder="username"
                            autocomplete="off"
                            rules="required|max:25"
                        >
                    </div>
                    <span class="error_message"></span>
                </div>
            
                <div class="email_container">
                    <label for="email">Email: </label>
                    <div class="form_group email">
                        <input 
                            type="text" 
                            name="email" 
                            placeholder="email"
                            autocomplete="off"
                            rules="required|email"
                        >
                    </div>
                    <span class="error_message"></span>
                </div>

            </div>
        </div>

        <label for="password">Password: </label>
        <div class="form_group password">
            <input 
                type="password" 
                name="password" 
                placeholder="password"
                autocomplete="off"
                rules="required|min:6|match"      
            >
        </div>
        <span class="error_message"></span>

        <label for="confirm_password">Confirm password: </label>
        <div class="form_group confirm_password">
            <input 
                type="password" 
                name="confirm_password" 
                placeholder="Confirm password"
                autocomplete="off"
                rules="required|min:6|match"   
            >
        </div>
        <span class="error_message"></span>


        <input 
            type="submit" 
            name="submit" 
            value="Submit" 
            id="submit"
        >

    </form>

</section>