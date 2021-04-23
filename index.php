<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");

    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM post");
    $statement->execute();
    $posts = $statement->fetchAll();

    foreach($posts as $post){
        // echo $post['text'];
        // echo "<img class='post__image' src='". $post['image'] ."' alt='post image'/>";
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Dinkstagram</title>
</head>
<body>
        <div class="header">
            <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
            <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button"/></a>
        </div>


        <div class="post">
            <div class="post__head">
                <img class="post_userImage" src="assets/cesarAlien.jpg" alt="Profile Picture"/>
                <p class="post_userName">Fons</p>
            </div>
            <img class="post__image" src="<?php echo $post['image']; ?>" alt="Post Image"/>
            <div class="post__foot">
                <div class="post__likes">
                    <a href="#"><img src="assets/icon_likes.svg" alt="Number of likes"/></a>
                    <span>5</span>
                </div>
                <div class="post__comments">
                    <a href="#"><img src="assets/icon_comments.svg" alt="Number of comments"/></a>
                    <span>5</span>
                </div>
            </div>
        </div>

    
        <nav class="navbar">
            <a class="navbar__btn" href="#">Home</a>
            <a class="navbar__btn" href="#">Add</a>
            <a class="navbar__btn" href="#">User</a>
            
        </nav>
    
</body>
</html>