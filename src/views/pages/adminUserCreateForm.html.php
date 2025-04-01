<?= ViewController::useComponent('backButton')?>

<section id="create_user_form">
    <form action="<?= BASE_URL ?>admin/user/create" method="POST">


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
                <div class="form_group role">
                    <select name="role">
                        <option value="1">Student</option>
                        <option value="2">Admin</option>
                    </select>
                </div>

                <div class="form_group username">
                    <input 
                        type="text" 
                        name="account_name" 
                        placeholder="username"
                        autocomplete="off"
                        required
                    >
                </div>
        
                <div class="form_group email">
                    <input 
                        type="text" 
                        name="email" 
                        placeholder="email"
                        autocomplete="off"
                        required
                    >
                </div>
            </div>
        </div>
 
        <div class="form_group password">
            <input 
                type="password" 
                name="password" 
                placeholder="password"
                autocomplete="off"
                required
            >
        </div>

        <div class="form_group confirm_password">
            <input 
                type="password" 
                name="confirm_password" 
                placeholder="Confirm password"
                autocomplete="off"
                required
            >
        </div>

        <input 
            type="submit" 
            name="submit" 
            value="Submit" 
            id="submit"
        >

    </form>

</section>