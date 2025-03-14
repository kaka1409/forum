<!DOCTYPE html>
<html lang="en">
<head>
    <?= ViewController::useComponent('head'); ?>
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
</body>
</html>