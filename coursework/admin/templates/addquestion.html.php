<form action="addquestion.php" method="post" enctype="multipart/form-data">
    <label for='questtext'>Type your question here:</label> <br>
    <textarea name="questtext" rows="3" cols="40"></textarea> <br><br>

    <select name="users">
        <option value="">Select an user</option>
        <?php foreach ($users as $user): ?>
            <option value="<?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach;?>
    </select>

    <select name="modules">
        <option value="">Select a module</option>
        <?php foreach ($modules as $module): ?>
            <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?=htmlspecialchars($module['name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach;?>
    </select>
    <br>
    <br>
    <label for="fileToUpload">Add your image (if necessary):</label> <br>
    <input type="file" name="fileToUpload">
    <br>
    <br>
    <input type="submit" name="submit" value="Add">

</form>