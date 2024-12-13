<?php
try{
    include '../includes/databaseconnection.php';

    $sql = 'DELETE FROM post WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    header('location: posts.php');
}catch(PDOException $e){
$title = 'An error has occurred';
$output = 'unable to connect to delete post: ' .$e->getMessage();

}
include '../templates/admin_layout.html.php';