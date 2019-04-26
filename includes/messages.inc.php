<aside id="message-console">
    <p id="messages-caption">Account Messages</p>
    <div id="message-container">
        <?php
            if (isset($resultStudentMessages))
            {
                foreach ($resultStudentMessages as $message)
                {
                    displayMessage($message);
                }
            }
            elseif (isset($resultFacultyMessages))
            {
                foreach ($resultFacultyMessages as $message)
                {
                    displayMessage($message);
                }
            }
        ?>
    </div>
</aside>

