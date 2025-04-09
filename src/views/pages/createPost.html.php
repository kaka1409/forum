<?= ViewController::useComponent('backButton')?>

<section class="post_form" style="overflow-y: hidden;" id="create_post_form">

    <form action="" method="POST">
        <h1 class="title">Create a new post</h1>

        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? null ?>">

        <!-- module selection -->
        <div class="form_group form_module">
            <select name="module" id="module" require>
                <!-- <option value="0">Select your module</option> -->
                <?php foreach ($modules as $module): ?>
                    <option 
                        value="<?=$module['module_id'] ?>"
                    >
                        <?= $module['module_name'] ?>
                    </option>
                <?php endforeach;?>
            </select>
        </div>

        <!-- post title -->
        <div class="form_group form_title">
            <input 
                type="text" 
                class="form-control" 
                id="title" 
                name="title" 
                placeholder="Enter title"
                max="100"
                required
            >
            <p class="char_count"></p>
        </div>
        <p class="error_message"></p>

        <!-- post thumbnail -->
        <div class="form_group thumbnail_container">
            <div class="thumbnail_title">
                <img 
                    width="20px"
                    height="20px"
                    src="<?=BASE_URL?>assets/icons/thumbnail.png" alt=""
                >
                <p>Thumbnail</p>
            </div>
            <input 
                type="file" 
                class="form-control" 
                id="thumbnail" 
                name="thumbnail" 
                placeholder="Enter thumbnail url"
                accept="image/*"
            >
            <img class="image_preview thumbnail" src="''">
        </div>

        <!-- post content -->
        <div class="form_group form_content">
            <textarea 
                class="form-control" 
                id="content" 
                name="content" 
                placeholder="Share your thoughts..."
                max="1000"
                required
            ></textarea>
            <p class="char_count"></p>
        </div>
        <p class="error_message"></p>

        <input type="submit" id="submit" name="submit" value="Post">
    </form>
</section>