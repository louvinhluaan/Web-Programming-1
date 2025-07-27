<p><?=$total?> questions</p>
<?php foreach($questions as $question): ?>
    <blockquote>
        <?=htmlspecialchars($question['questtext'], ENT_QUOTES, 'UTF-8') ?> <br>
        
        <img height="100px" src="../user/images/<?=htmlspecialchars($question['images'], ENT_QUOTES, 'UTF-8'); ?>">

        <br> Module <?=htmlspecialchars($question['module_name'], ENT_QUOTES, 'UTF-8'); ?>
        <br> (by <a href="mailto:<?=htmlspecialchars($question['email'], ENT_QUOTES, 'UTF-8');?>">
        <?=htmlspecialchars($question['user_name'], ENT_QUOTES, 'UTF-8'); ?></a>)
        
        <!-- neu duoc hay thu them time sau 2025 -->
        <?php $display_date = date("M d, Y", strtotime($question['questdate']))?>   
        <?=htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8')?>

        <a href="editquestion.php?id=<?=$question['id']?>">Edit</a>

        <form action="deletequestion.php" method="post">
            <input type="hidden" name="id" value="<?=$question['id']?>">
            <input type="submit" value="Delete">
        </form>
        
        

        
    </blockquote>
    <?php endforeach;?>