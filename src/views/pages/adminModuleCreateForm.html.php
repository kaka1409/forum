<?= ViewController::useComponent('backButton')?>

<section id="create_module_form">
    <form action="<?= BASE_URL ?>admin/module/create" method="POST">
        
        <div class="form_group module_name">
            <input 
                type="text" 
                name="module_name" 
                placeholder="Enter module name"
                required
                autocomplete="off"
            >
        </div>

        <div class="form_group module_teacher">
            <input 
                type="text"
                name="teacher"
                placeholder="Enter teacher name"
                required
                autocomplete="off"
            >
        </div>

        <div class="form_group module_description">
            <textarea 
                name="description" 
                placeholder="Enter module description"
                required
                autocomplete="off"    
            ></textarea>
        </div>

        <input type="submit" name="submit" value="Submit" id="submit">
    </form>
</section>
