<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="posts.css">
        <title><?=$title?></title>
    </head>
    <body>
        <header><h1>Internet post database</h1></header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="posts.php">questions list</a></li>
               <!-- <li><a href="addpost.php">add a new questions</a></li> -->
              <!--  <li><a href="admin/posts.php">Admin</a></li>-->
                <li><a href="admin/login/Login.html">Login</a></li>
            </ul>
        </nav>
        <main>
            <?=$output?>    
        </main>
        <footer>&copy; IJDB 2023</footer>
    </body>
</html>
