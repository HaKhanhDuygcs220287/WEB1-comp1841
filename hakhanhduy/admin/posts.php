<?php
try {
    include '../includes/databaseconnection.php';
    include '../includes/Databasefunctions.php';
    $pdo = new PDO('mysql:host=localhost;dbname=comp1841;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Initialize variables
    $moduleFilter = null;
    $sql = 'SELECT post.id, post.posttext, post.postdate, post.post_pic, people.name, people.email, modulename 
            FROM post 
            INNER JOIN people ON post.peopleid = people.id
            INNER JOIN module ON post.moduleid = module.id';

    // Check if a module filter is set via GET
    if (isset($_GET['moduleid']) && !empty($_GET['moduleid'])) {
        $moduleFilter = (int)$_GET['moduleid']; // Sanitize input
        $sql .= ' WHERE post.moduleid = :moduleid'; // Add WHERE clause for filtering
    }

    // Prepare the query
    $stmt = $pdo->prepare($sql);
    $totalposts = totalposts($pdo);
    
    // Bind the module filter if set
    if ($moduleFilter !== null) {
        $stmt->bindValue(':moduleid', $moduleFilter, PDO::PARAM_INT);
    }

    // Execute the query and fetch results
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set the page title
    $title = 'Post List';

    // Use output buffering to include the template
    ob_start();
    include '../templates/posts.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

// Include the layout
include '../templates/admin_layout.html.php';
