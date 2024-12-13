<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../posts.css">
        <title><?=$title?></title>
    </head>
    <body>
        <header id="admin">
            <h1>Internet post database Admin Area<br />
        Manage post, module and people</h1>
        </header>

        <nav>
            <ul>
                <!--<li><a href="../index.php">Public Site</a></li>-->
                <li><a href="posts.php">post list</a></li>
                <li><a href="addpost.php">add a new post</a></li>
                <li><a href="login/Logout.html">Logout</a></li>
            </ul>
        </nav>
        <main>
            <?=$output?>
        </main>
        <footer>&copy; IJDB 2023</footer>
    </body>
</html>
