<!DOCTYPE html>
<html lang="en">
<head>
    <?= ViewController::useComponent('head', ['title' => $title]); ?>
</head>
<body>
    <!-- HEADER -->
    <?= ViewController::useComponent('header'); ?>

    <!-- MAIN -->
    <main class="main_container">

        <!-- SIDEBAR -->
        <?= ViewController::useComponent('sidemenu'); ?>

        <!-- MAIN CONTENT -->
        <main class="main_content">    
            <?=$content?>
        </main>

    </main>

    <!-- MODAL -->
    <?= ViewController::useComponent('modal'); ?>

    <script src="<?=BASE_URL?>assets/scripts/main.js"></script>
</body>
</html>