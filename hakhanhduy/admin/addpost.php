<?php
if (isset($_POST['posttext'])) {
    try {
        include '../includes/DatabaseConnection.php'; // Ensure correct file path
        include '../includes/DatabaseFunctions.php'; // Include helper functions

        // Default `peopleid` to 1 if not provided or invalid
        $peopleid = isset($_POST['peopleid']) && !empty($_POST['peopleid']) ? $_POST['peopleid'] : 1;

        // Default `moduleid` to 3 if not provided or invalid
        $moduleid = isset($_POST['moduleid']) && !empty($_POST['moduleid']) ? $_POST['moduleid'] : 3;

        // Use a helper function to insert the post into the database
        insertPost($pdo, $_POST['posttext'], $peopleid, $moduleid);

        // Redirect to the posts list after successful insertion
        header('Location: posts.php');
    } catch (PDOException $e) {
        // Handle database-related errors
        $title = 'An error occurred';
        $output = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        // Handle general errors
        $title = 'An error occurred';
        $output = 'Error: ' . $e->getMessage();
    }
} else {
    // Prepare for rendering the "Add a new post" form
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    $title = 'Add a new questions';

    // Fetch available people for dropdown
    $people = allPeople($pdo);

    // Fetch available modules for dropdown
    $modules = allModules($pdo);

    // Render the form
    ob_start();
    include '../templates/addpost.html.php'; // Ensure this template exists
    $output = ob_get_clean();
}

// Include the layout
include '../templates/admin_layout.html.php';
?>
