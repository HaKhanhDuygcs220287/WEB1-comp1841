<?php if (!empty($posts) && is_array($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <blockquote>
            <!-- Display post text -->
            <p><?= htmlspecialchars($post['posttext'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            
            <!-- Display module name -->
            <p>Module: <?= htmlspecialchars($post['modulename'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>

            <!-- Display author with email -->
            <p>By 
                <a href="mailto:<?= htmlspecialchars($post['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($post['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </a>
            </p>

            <!-- Display image if available -->
            <?php if (!empty($post['post_pic'])): ?>
                <div>
                    <img src="data:image/jpeg;base64,<?= base64_encode($post['post_pic']) ?>" alt="Post Image" style="max-width: 100%; height: auto;" />
                </div>
            <?php endif; ?>

            <!-- Actions: Delete and Edit -->
            <form action="deletepost.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($post['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <input type="submit" value="Delete">
            </form>
            <a href="editpost.php?id=<?= htmlspecialchars($post['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">Edit</a>

            <!-- Display formatted post date -->
            <?php if (!empty($post['postdate'])): ?>
                <p>Posted on: 
                    <?= htmlspecialchars(date("D, d M Y", strtotime($post['postdate'])), ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>
        </blockquote>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>No posts available.</p>
<?php endif; ?>
