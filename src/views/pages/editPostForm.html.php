<!-- Back to home -->
<a class="back_btn" href="<?= BASE_URL?>home">
    <img src="<?=BASE_URL?>/assets/icons/back.png" alt="" width="18px" height="18px">
    <p>Back</p>
</a>

<section class="post_form" style="overflow-y: hidden;">
    <form action="" method="POST">
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
                value="<?= htmlspecialchars($post_data['title'])?>"
                required
            >
            <p id="title_char_count"></p>
        </div>

        <!-- post thumbnail -->
        <button type="button" class="form_group form_thumbnail">
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
                id="thumbnail_preview" 
                src="<?= htmlspecialchars($post_data['thumbnail_url']) == UPLOAD_FOLDER ? '/forum/uploads/default.png' : ROOT_URL . htmlspecialchars($post_data['thumbnail_url']) ;?>"
                style="display: block;"
            >
        </button>

        <!-- post content -->
        <div class="form_group form_content">
            <textarea 
                class="form-control" 
                id="content" 
                name="content" 
                placeholder="Share your thoughts..."
                required
            ><?= htmlspecialchars($post_data['content'])?></textarea>
            <p id="content_char_count"></p>
        </div>

        <input type="submit" id="submit" name="submit" value="Update">
    </form>
</section>