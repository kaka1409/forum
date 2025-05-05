<!-- Back to home -->
<?= ViewController::useComponent('backButton')?>

<section class="post_form" style="overflow-y: hidden;" id="edit_post_form">
    <form action="<?=BASE_URL?>post/<?=$post_data['post_id']?>/edit" method="POST" enctype="multipart/form-data">
        <h1 class="title">Edit post</h1>

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
        <div class="container">
            <div class="form_group form_title">
                <input 
                    type="text" 
                    class="form-control" 
                    id="title" 
                    name="title" 
                    placeholder="Enter title"
                    value="<?= htmlspecialchars($post_data['title'])?>"
                    max="100"
                    autocomplete="off"
                >
                <p class="char_count"></p>
            </div>
            <span class="error_message"></span>
        </div>

        <!-- post thumbnail -->
        <div class="form_group thumbnail_container">
            <div class="thumbnail_title" style="display: none;">
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
                value="<?= ROOT_URL ?><?= htmlspecialchars($post_data['thumbnail_url'])?>"
            >
            <img 
                class="image_preview" 
                src="<?=ROOT_URL . htmlspecialchars($post_data['thumbnail_url']) ;?>"
                style="display: block;"
            >
        </div>

        <!-- post content -->
        <div class="container">
            <div class="form_group form_content">
                <textarea 
                    class="form-control" 
                    id="content" 
                    name="content" 
                    placeholder="Share your thoughts..."
                    max="1000"
                    autocomplete="off"
                ><?= htmlspecialchars($post_data['content'])?></textarea>
                <p class="char_count"></p>
            </div>
            <span class="error_message"></span>
        </div>

        <input type="submit" id="submit" name="submit" value="Update">
    </form>
</section>