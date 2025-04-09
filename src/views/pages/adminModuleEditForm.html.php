<?= ViewController::useComponent('backButton')?>

<section id="edit_module_form">
    <form action="<?= BASE_URL ?>admin/module/edit/<?= $module['module_id'] ?>" method="POST">
        <h1 class="title">Edit a module</h1>
        
        <div class="container">
            <label for="module_name">Name: </label>
            <div class="form_group module_name">
                <input 
                    type="text" 
                    name="module_name" 
                    placeholder="Enter module name"
                    max="100"
                    autocomplete="off"
                    value="<?= $module['module_name']?>"
                >
                <p class="char_count"></p>
            </div>
            <span class="error_message"></span>
        </div>

        <div class="container">
            <label for="module_name">Teacher: </label>
            <div class="form_group module_teacher">
                <input 
                    type="text"
                    name="teacher"
                    placeholder="Enter teacher name"
                    max="50"
                    autocomplete="off"
                    value="<?= $module['teacher']?>"
                >
                <p class="char_count"></p>
            </div>
            <span class="error_message"></span>
        </div>

        <div class="container">
            <label for="module_name">Description: </label>
            <div class="form_group module_description">
                <textarea 
                    name="description" 
                    placeholder="Enter module description"
                    max="1000"
                    autocomplete="off"    
                ><?= htmlspecialchars($module['description']) ?></textarea>
                <p class="char_count"></p>
            </div>
            <span class="error_message"></span>
        </div>

        <input type="submit" name="submit" value="Submit" id="submit">
    </form>
</section>
