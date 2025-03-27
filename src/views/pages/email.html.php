<section class="post_form" style="overflow-y: hidden;" id="contact_email_container">
    
    <form action="<?= BASE_URL ?>email" method="POST" id="contact_email">
        <div class="form_title">
            <h1>Send an email to contact admin</h1>
        </div>

        <div class="form_group email_container">
            <input 
                type="text" 
                name="email_title" 
                id="email_title" 
                placeholder="Email title" 
                required
            >
        </div>

        <div class="form_group email_content_container">
            <textarea 
                name="email_content" 
                id="email_content" 
                placeholder="Share your thoughts for admins"
                required
            ></textarea>
        </div>

        <input type="submit" id="submit" name="submit" value="Send">
    </form>

    <aside class="messages_container">
        <div class="title">
            <h1>Your messages</h1>
        </div>

        <div class="messages">
            <?php foreach($messages as $message): ?>
                <div class="message">

                    <div class="message_title">
                        <h1>
                            <?= htmlspecialchars($message['title']) ?>
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
            <?php endforeach; ?>
        </div>
    </aside>
</section>