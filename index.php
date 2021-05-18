<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Post.php");
    include_once(__DIR__ . "/classes/Comment.php");
    
    session_start();
    if(!isset($_SESSION['id'])) {
        header('location: login.php');
    } else{
        $sessionId = $_SESSION['id'];
        $userData = User::getUserDataFromId($sessionId);
    }

    $p = new Post;
    $allPosts = $p->getAllPosts();
    //var_dump($allPosts[3]['id']);

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
        <?php include "header.php" ?>

        <section class="posts">
            <?php foreach($allPosts as $post): ?>  
            <?php $allComments = Comment::getSome($post['id']); ?>
                <div class="post">
                <!-- Head of the post -->
                    <div class="post__head">
                        <img class="post__userImage" src="profile_pictures/<?php echo $p->getUserdataByPostId($post['id'])['profile_picture']; ?>" alt="Profile Picture"/>
                        <a href="profile.php?id=<?php echo $post['users_id']; ?>" class="post__userName" rel="author"><?php echo $p->getUserdataByPostId($post['id'])['firstname'] . " " . substr($p->getUserdataByPostId($post['id'])['lastname'], 0, 1) . "."; ?></a>
                        <?php echo ''/*'post id: ' . $post['id'];*/ ?></div>

                <!-- Content of the post -->
                    <div class="post__content">
                        <p class="post__text"><?php echo htmlspecialchars($post['text']); ?></p>
                        <img class="post__image" src="post_pictures/<?php echo $p->getUserdataByPostId($post['id'])['image'];; ?>" alt="Post Image"/>
                    </div>

                <!-- Foot of the post -->
                    <div class="post__foot">
                        <div class="post__foot__likes">
                            <a href="#"><img src="assets/icon_likes.svg" alt="Number of likes"/></a>
                            <span>5</span>
                        </div>
                        <div class="post__foot__comments">
                            <a href="#"><img src="assets/icon_comments.svg" alt="Number of comments"/></a>
                            <span class="commentCount"><?php echo count($allComments); ?></span>
                        </div>
                    </div>

                <!-- Comment section -->
                    <div class="post__comments">
                        <div class="post__comments__form">
                            <div class="form__input comments__container">
                                <input type="text" id="commentText" placeholder="What's on your mind">
                                <a style="display:none" href="#" class="btn" id="btnAddComment" data-postid="<?php echo $post['id']; ?>" data-username="<?php echo $userData['firstname']; ?>" data-profilepicture="<?php echo $userData['profile_picture']; ?>">+</a>
                            </div>
                        </div>  
                
                        <ul class="post__comments__list">
                            <?php  foreach($allComments as $comment):  ?>
                                <li>
                                    <div>
                                        <img src="profile_pictures/<?php echo $comment['profile_picture']; ?>" alt="Profile picture">
                                        <span><?php echo '- ' . $comment['firstname']; ?></span>
                                    </div>
                                    <p><?php echo $comment['text']; ?></p>
                                </li>
                                <li><a href="comments.php?id=<?php echo $post['id']; ?>" >Load more</a></li>
                            <?php  endforeach;  ?>
                        </ul>
                    </div>
                </div>

                <!-- detail comments -->
       
            <?php endforeach; ?>
        </section>

        
        
        <?php include "navbar.php" ?>
        
        <script src="javascript/app.js"></script>
</body>
</html>