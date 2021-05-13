<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Post.php");
    
    session_start();
    if(!isset($_SESSION['id'])) {
        header('location: login.php');
    } else{
        $sessionId = $_SESSION['id'];
        $userData = User::getUserDataFromId($sessionId);
    }

    $p = new Post;
    $allPosts = $p->getAllPosts();
    //var_dump($allPosts['id']);



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Dinkstagram</title>
    <link rel="shortcut icon" type="image/svg" href="assets/favicon.svg">
</head>
<body>
        <div class="header">
            <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
            <div class="header__user">
                <a  class="search" href="#"><img src="./assets/icon_search.svg" alt="Search button"/></a>
                <img class="header__profilePicture" src="profile_pictures/<?php echo $userData['profile_picture']; ?>" alt="Profile picture">
                <span class="header__username"><?php echo htmlspecialchars($userData['firstname']); ?></span>
            </div>
        </div>

        <section class="posts">
            <?php foreach($allPosts as $post): ?>
                
            <div class="post">
                <div class="post__head">
                    <img class="post__userImage" src="profile_pictures/<?php echo $p->getUserdataByPostId($post['id'])['profile_picture']; ?>" alt="Profile Picture"/>
                    <a class="post__userName" rel="author"><?php echo $p->getUserdataByPostId($post['id'])['firstname'] . " " . substr($p->getUserdataByPostId($post['id'])['lastname'], 0, 1) . "."; ?></a>
                </div>
                <div class="post__content">
                    <p class="post__text"><?php echo htmlspecialchars($post['text']); ?></p>
                    <img class="post__image" src="post_pictures/<?php echo $p->getUserdataByPostId($post['id'])['image'];; ?>" alt="Post Image"/>
                </div>
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
       
            <?php endforeach; ?>
        </section>
    
        <nav class="navbar">
            <a class="navbar__btn" href="index.php">Home</a>
            <a class="navbar__btn" href="add.php">Add</a>
            <a class="navbar__btn" href="usersettings.php">User</a>
            
        </nav>
    
</body>
</html>