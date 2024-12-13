<?php
include '../includes/DatabaseConnection.php';

try {
    // Check if the form was submitted
    if (isset($_POST['posttext'])) {
        // Update the post in the database
        $sql = 'UPDATE post SET posttext = :posttext WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':posttext', $_POST['posttext']);
        $stmt->bindValue(':id', $_POST['postid']);
        $stmt->execute();

        // Redirect to the posts list
        header('Location: posts.php');
    } else {
        // Retrieve the post data for editing
        $sql = 'SELECT * FROM post WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $post = $stmt->fetch();
        $title = 'Edit post';

        // Render the edit form
        ob_start();
        include '../templates/editpost.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    // Handle errors
    $title = 'An error occurred';
    $output = 'Error editing post: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php';
?>
