<?php
function totalPosts($pdo) {
    try {
        $query = $pdo->prepare('SELECT COUNT(*) FROM post');
        $query->execute();
        $row = $query->fetch();
        return $row[0] ?? 0; // Return 0 if no row is found
    } catch (PDOException $e) {
        // Log or handle error
        return 0;
    }
}

function getPost($pdo, $id) {
    try {
        $parameters = [':id' => $id];
        $query = executeQuery($pdo, 'SELECT * FROM post WHERE id = :id', $parameters);
        return $query->fetch(PDO::FETCH_ASSOC) ?? null; // Return null if no record found
    } catch (PDOException $e) {
        // Log or handle error
        return null;
    }
}

function executeQuery($pdo, $sql, $parameters = []) {
    try {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    } catch (PDOException $e) {
        // Log or handle error
        throw $e; // Rethrow exception for caller to handle
    }
}

function updatePost($pdo, $postid, $posttext) {
    try {
        $sql = 'UPDATE post SET posttext = :posttext WHERE id = :id';
        $parameters = [':posttext' => $posttext, ':id' => $postid];
        executeQuery($pdo, $sql, $parameters);
    } catch (PDOException $e) {
        // Log or handle error
        throw $e;
    }
}

function deletePost($pdo, $id) {
    try {
        $parameters = [':id' => $id];
        executeQuery($pdo, 'DELETE FROM post WHERE id = :id', $parameters);
    } catch (PDOException $e) {
        // Log or handle error
        throw $e;
    }
}

function insertPost($pdo, $posttext, $peopleid, $moduleid) {
    try {
        $sql = 'INSERT INTO post (posttext, postdate, peopleid, moduleid)
                VALUES (:posttext, CURDATE(), :peopleid, :moduleid)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':posttext', $posttext);
        $stmt->bindValue(':peopleid', $peopleid, PDO::PARAM_INT);
        $stmt->bindValue(':moduleid', $moduleid, PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId(); // Return the ID of the inserted record
    } catch (PDOException $e) {
        // Log or handle error
        throw $e;
    }
}

function allPeople($pdo) {
    try {
        $sql = 'SELECT id, name FROM people';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log or handle error
        return [];
    }
}

function allModules($pdo) {
    try {
        $sql = 'SELECT id, name FROM module';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log or handle error
        return [];
    }
}

function allPosts($pdo) {
    try {
        $sql = 'SELECT 
                    post.id, 
                    post.posttext, 
                    people.name AS people, 
                    people.email AS people_email, 
                    modulename AS module.name 
                FROM post 
                INNER JOIN people ON post.peopleid = people.id 
                INNER JOIN module ON post.moduleid = module.id';
        $posts = executeQuery($pdo, $sql);
        return $posts->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log or handle error
        return [];
    }
}
