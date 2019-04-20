<aside id="message-console">
    <p id="messages-caption">Account Messages</p>
    <div id="message-container">
        <?php
            if (isset($resultStudentMessages))
            {
                foreach ($resultStudentMessages as $message)
                {
                    echo '<div class="message-card">';
                    echo '    <div class="message-subject">';
                    echo $message['messageSubject'];
                    echo '    </div>';
                    echo '    <div class="message-body">';
                    echo '        <p class="message-body-text">' . nl2br($message['messageBody']) . '</p>';
                    if ($message['messageSender'] !== null)
                    {
                        echo '<span>- </span><a href="mailto: ' . $message['messageSender'] . '" class="message-body-from">' . $message['messageSender'] . '</a>';
                    }
                    echo '        <p class="message-body-timestamp">' . $message['messageTime'] . '</p>';
                    echo '    </div>';
                    echo '</div>';
                }
            }
        ?>
    </div>
</aside>

