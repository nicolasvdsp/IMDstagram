<?php
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__. "/classes/User.php");
    include_once(__DIR__ . "/classes/Post.php");
    include_once(__DIR__ . "/classes/Comment.php");

    session_start();
        if(!isset($_SESSION['id'])) {
            header('location: login.php');
        } else{
            $sessionId = $_SESSION['id'];
        }
    
    $tagsId = $_GET['id'];
    $posts = (new Post)->getPostsByTagId($tagsId);
    $allPosts = (new Post)->getAllPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/temp.css">
    <title>Dinkstagram</title>
</head>
<body>
        <?php include "header.php" ?>
        
        <p class="tags__head">Meer in deze #tag ?!</p>
        
        <section class="posts">
        <?php foreach($posts as $post): ?> 
            <?php $allComments = Comment::getAll($allPosts['id']); ?>
                <div class="post">
                <!-- Head of the post -->
                    <div class="post__head">
                        <img class="post__userImage" src="profile_pictures/<?php echo $post['profile_picture']; ?>" alt="Profile Picture"/>
                        <a href="profile.php?id=<?php echo $post['users_id']; ?>" class="post__userName" rel="author"><?php echo $post['firstname'] . " " . substr($post['lastname'], 0, 1) . "."; ?></a>
                        <?php echo ''/*'post id: ' . $post['id'];*/ ?></div>

                <!-- Content of the post -->
                    <div class="post__content">
                        <p class="post__text"><?php echo htmlspecialchars($post['text']); ?></p>
                        <img class="post__image" src="post_pictures/<?php echo $post['image'];; ?>" alt="Post Image"/>
                        <a href="tags.php?id=<?php echo $post['tags_id']; ?>" class="post__tag"><?php echo "#".$post['tags_name']; ?></a>
                    </div>
                </div>
       
            <?php endforeach; ?>
        </section>
        
        <?php include "navbar.php" ?>
        
    
</body>
</html>
