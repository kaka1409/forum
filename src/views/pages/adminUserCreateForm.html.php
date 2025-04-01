<?= ViewController::useComponent('backButton')?>

<section id="create_user_form">
    <form action="<? BASE_URL ?>admin/user/create" method="POST">


        <div class="form_head">
            <div class="avatar_container">
                <img src="<?= ROOT_URL ?>uploads/account/default.jpg" alt="">
            </div>

            <div class="user_details">
                <div class="form_group username">
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="username"
                        autocomplete="off"
                    >
                </div>
        
                <div class="form_group email">
                    <input 
                        type="text" 
                        name="email" 
                        placeholder="email"
                        autocomplete="off"
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
            >
        </div>

        <div class="form_group confirm_password">
            <input 
                type="password" 
                name="confirm_password" 
                placeholder="password"
                autocomplete="off"
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