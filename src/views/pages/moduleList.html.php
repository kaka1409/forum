<div class="modules_container">
    <?php foreach ($modules as $module): ?>
        <a href="<?= BASE_URL?>module/<?=$module['module_id']?>">
            <div class="module_border">
                <div class="module">
        
                    <!-- module title -->
                    <div class="title">
                        <h1>
                            <?= htmlspecialchars($module['module_name'])?>
                        </h1>
                    </div>
        
                    <!-- module teacher -->
                    <div class="teacher">
                        <p>
                            <?= htmlspecialchars($module['teacher'])?>
                        </p>
                    </div>
        
                    <!-- module posts count -->
        
                    <div class="posts_count">
                        <?php
                            $posts_count_result = Module::countPostById($db, $module['module_id']);
                            $posts_count_result = $posts_count_result[0]['COUNT(module_id)'];
        
                            $post_count = intval($posts_count_result) > 1 ? $posts_count_result .' posts' : $posts_count_result . ' post';
                        ?>
        
                        <p>
                            <?= htmlspecialchars($post_count) ?> 
                        </p>
                    </div>
        
        
                    <!-- module description -->
                    <div class="description">
                        <?= htmlspecialchars($module['description']) ?>
                    </div>
        
                    <button class="module_view">View module</button>
                </div>
            </div>
        </a>

    <?php endforeach; ?>
</div>