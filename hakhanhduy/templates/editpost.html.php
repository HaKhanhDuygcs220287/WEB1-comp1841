<form action="" method="post">
    <!-- Hidden input for post ID -->
    <input type="hidden" name="postid" value="<?= htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Label and textarea for editing post text -->
    <label for="posttext">Edit your post here:</label>
    <textarea name="posttext" rows="3" cols="40">
        <?= htmlspecialchars($post['posttext'], ENT_QUOTES, 'UTF-8'); ?>
    </textarea>

    <!-- Submit button -->
    <input type="submit" name="submit" value="Save">
</form>
