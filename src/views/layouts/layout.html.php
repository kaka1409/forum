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
    <?= ViewController::useComponent('modal', [
        'modalTitle' => "Don't have an account",
        'modalMessage' => "To use this feature you need to have an account",
    ]); ?>

    <!-- SCRIPTS -->
    <?php authStatusJS()?>
    <script src="<?=BASE_URL?>assets/scripts/main.js"></script>
</body>
</html>