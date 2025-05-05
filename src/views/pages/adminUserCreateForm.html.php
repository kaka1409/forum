<?= ViewController::useComponent('backButton')?>

<section id="create_user_form">
    <form action="<?=BASE_URL?>admin/user/create" method="POST" enctype="multipart/form-data">
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
                    accept="image/*"
                    hidden
                >

                <img 
                    src=""  
                    alt=""
                    class="image_preview avatar"
                >
                
            </div>

            <div class="user_details">
                <div class="username_container container">
                    <label for="account_name">Username: </label>
                    <div class="form_group username">
                        <input 
                            type="text" 
                            name="account_name" 
                            placeholder="username"
                            autocomplete="off"
                        >
                    </div>
                    <span class="error_message"></span>
                </div>
            
                <div class="email_container container">
                    <label for="email">Email: </label>
                    <div class="form_group email">
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="email"
                            autocomplete="off"
                        >
                    </div>
                    <span class="error_message"></span>
                </div>

            </div>
        </div>

        <div class="container">
            <label for="password">Password: </label>
            <div class="form_group password">
                <input 
                    type="password" 
                    name="password" 
                    placeholder="password"
                    autocomplete="off"
                >
            </div>
            <span class="error_message"></span>
        </div>

        <div class="container">
            <label for="confirm_password">Confirm password: </label>
            <div class="form_group confirm_password">
                <input 
                    type="password" 
                    name="confirm_password" 
                    placeholder="Confirm password"
                    autocomplete="off"
                    rules="min:6|match:password|required"   
                >
            </div>
            <span class="error_message"></span>
        </div>

        <input 
            type="submit" 
            name="submit" 
            value="Submit" 
            id="submit"
        >

    </form>

</section>