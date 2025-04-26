<!DOCTYPE html>
<html lang="en">
<head>
    <?= ViewController::useComponent('loginHead', ['title' => $title]); ?>
</head>
<body>
    <div class="account_form_container">
        <img 
            id="login_bg" 
            src="<?=BASE_URL?>/assets/images/login_bg<?=mt_rand(1, 3)?>.png" 
            alt=""
        >
        
        <div>
            <?= $content; ?>
        </div>
    </div>

    <script type="module" src="<?=BASE_URL?>assets/scripts/main.js"></script>
</body>
</html>
