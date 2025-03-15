<section class="post_form" style="overflow-y: hidden;">
    <form action="<?=BASE_URL?>post/create" method="POST">

        <!-- module selection -->
        <div class="form_group form_module">
            <select name="module" id="module">
                <option value="0">Select your module</option>
                <option value="1">Module 1</option>
                <option value="2">Module 2</option>
                <option value="3">Module 3</option>
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
            >
        </div>

        <!-- post thumbnail -->
        <div class="form_group form_thumbnail">
            <input 
                type="file" 
                class="form-control" 
                id="thumbnail" 
                name="thumbnail" 
                placeholder="Enter thumbnail url"
            >
            <img id="thumbnail-preview" src="">
        </div>

        <!-- post content -->
        <div class="form_group form_content">
            <textarea 
                class="form-control" 
                id="content" 
                name="content" 
                placeholder="Share your thoughts..."
            ></textarea>
        </div>

        <button type="submit" class="submit_btn">Post</button>
    </form>
</section>