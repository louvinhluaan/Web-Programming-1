<?php foreach($users as $user): ?>
    <blockquote>
        <?=htmlspecialchars($user["name"], ENT_QUOTES, 'UTF-8'); ?>
    </blockquote>
    <?php endforeach;?>




