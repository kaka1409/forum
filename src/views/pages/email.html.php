<section class="post_form" style="overflow-y: hidden;" id="contact_email_form">
    
    <form action="<?= BASE_URL ?>email" method="POST" id="contact_email">
        <div class="form_title">
            <h1>Send an email to contact admin</h1>
        </div>

        <div class="container">
            <div class="form_group email_title_container">
                <input 
                    type="text" 
                    name="email_title" 
                    id="email_title" 
                    placeholder="Email title" 
                    autocomplete="off"
                    max="100"
                >
                <p class="char_count"></p>
            </div>
            <span class="error_message"></span>
        </div>

        <div class="container">
            <div class="form_group email_content_container">
                <textarea 
                    name="email_content" 
                    id="email_content" 
                    placeholder="Share your thoughts for admins"
                    max="1000"
                ></textarea>
                <p class="char_count"></p>
            </div>
            <span class="error_message"></span>
        </div>

        <input type="submit" id="submit" name="submit" value="Send">
    </form>

    <aside class="messages_container">
        <div class="title">
            <h1>Your messages</h1>
        </div>

        <div class="messages">
            <?php if (!empty($messages)): ?>
                <?php foreach($messages as $message): ?>
                    <a href="<?= BASE_URL . 'message/' . $message['message_id'] ?>">
                        <div class="message">
                            <div class="message_title">
                                <h1>
                                    <?= 
                                        htmlspecialchars(
                                            truncateText($message['title'], 10)
                                        ) 
                                    ?>
                                </h1>
        
                                <p class="message_status <?= htmlspecialchars($message['status']) ?>">
                                   &bull; <?= htmlspecialchars($message['status']) ?>
                                </p>
                            </div>
        
                            <p class="message_date">
                                <?=
                                    htmlspecialchars(
                                        dateFormat($message['sent_at'])
                                    )
                                ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no_messages">You have no messages</p>
            <?php endif; ?>
        </div>
    </aside>
</section>