<!DOCTYPE html>
<html lang="en">
<head>
    <?= ViewController::useComponent('login_head', ['title' => $title]); ?>
</head>
<body>
    <div class="login_container">
        <img id="login_bg" src="<?=BASE_URL?>/assets/images/login_bg<?=mt_rand(1, 3)?>.png" alt="">
    </div>
</body>
</html>
