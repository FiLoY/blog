<div class="<?php echo $message_class; ?>">
    <span><?php echo $message; ?></span>
    <div>
        <?php
            if (isset($err)) {
                foreach ($err as $item) {
                    echo "<li>" . $item . "</li>";
                }

            }
        ?>
    </div>
</div>
