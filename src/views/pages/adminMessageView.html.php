
<?= ViewController::useComponent('backButton')?>

<section id="message_view">
    <div class="container">
        <div class="message_header">
            <div class="message_author">
                Sent by 
                <div class="avatar_container">
                    <img src="<?= ROOT_URL . $message['account_avatar']?>" alt="">
                </div>
                <span> <?= $message['account_name'] ?> </span>
            </div>
            
            <p>
                <?= explode(' ', $message['sent_at'])[0] ?>
            </p>
        </div>

        <div class="message_title">
            <h3 for="title">Title: </h3>
            <p>
                <?= htmlspecialchars($message['title']) ?>
            </p>
        </div>
        
        <div class="message_content">
            <h3 for="content">Content: </h3>
            <p>
                <?= htmlspecialchars($message['content']) ?>
            </p>
        </div>

        <button class="btn submit"> Reply </button>
    </div>
</section>
