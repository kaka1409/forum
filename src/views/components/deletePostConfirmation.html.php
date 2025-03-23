<div class="delete_confirmation modal">
    <div class="pop_up">
        <h1><?= $modalTitle ?></h1>
        <p><?= $modalMessage ?></p>
        <img src="<?=BASE_URL?>assets/icons/exit.png" alt="">
        <div class="btn_container">
            <form action="<?=BASE_URL?>post/<?=$post_id?>/delete" method="POST">
                <input type="submit" name="submit" value="Confirm">
            </form>
            <a href="<?=BASE_URL?>home">Cancel</a>
        </div>
    </div>
</div>