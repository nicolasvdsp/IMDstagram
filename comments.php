<?php
ini_set('display_errors', true);
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Post.php");
include_once(__DIR__ . "/classes/Comment.php");
include_once(__DIR__ . "/classes/Like.php");

session_start();
if(!isset($_SESSION['id'])) {
    header('location: login.php');
} else{
    $sessionId = $_SESSION['id'];
    $userData = User::getUserDataFromId($sessionId);
}

$postId = $_GET['id'];

$p = new Post;
$allPosts = $p->getPost($postId);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dinkstagram</title>
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/temp.css">
</head>

<body>
  
<section class="posts comments__post">
            <?php include "header.php" ?>

            <?php foreach($allPosts as $post): ?>  
            <?php $allComments = Comment::getAll($post['id']); ?>
            <?php $allLikes = Like::getAll($post['id']); ?>
                <div class="post detail__post">
                <!-- Head of the post -->
                    <div class="post__head detail__head">
                        <img class="post__userImage" src="profile_pictures/<?php echo $p->getUserdataByPostId($post['id'])['profile_picture']; ?>" alt="Profile Picture"/>
                        <a href="profile.php?id=<?php echo $post['users_id']; ?>" class="post__userName" rel="author"><?php echo $p->getUserdataByPostId($post['id'])['firstname'] . " " . substr($p->getUserdataByPostId($post['id'])['lastname'], 0, 1) . "."; ?></a>
                        <?php echo ''/*'post id: ' . $post['id'];*/ ?></div>

                <!-- Content of the post -->
                    <img class="post__image detail__image" src="post_pictures/<?php echo $p->getUserdataByPostId($post['id'])['image'];; ?>" alt="Post Image"/>
                    <div class="detail__text">
                        <p class="post__text"><?php echo htmlspecialchars($post['text']); ?></p>
                        <?php if (!empty($post['tags_id'])): ?>
                        <a href="tags.php?id=<?php echo $p->getTagsByPostId($post['id'])['tags_id'] ?>" class="post__tag"><?php echo "#".$p->getTagsByPostId($post['id'])['tags_name']; ?></a>
                        <?php endif; ?>
                    </div>

                <!-- Foot of the post -->
                    <div class="post__foot detail__foot">
                    <div class="likesContainer">
                        <div class="post__foot__likes">
                                <?php if(Like::isPostLiked($user['id'], $post['id'])): ?>
                                    <a href="#" id="btnAddLike" data-postid="<?php echo $post['id']; ?>" data-isliked="false" data-username="<?php echo $userData['firstname']; ?>" data-userid="<?php echo $userData['id']; ?>"><img class="iconLike" src="assets/icon_likes.svg" alt="Number of likes"/></a>
                                <?php else: ?>
                                    <a href="#" id="btnAddLike" data-postid="<?php echo $post['id']; ?>" data-isliked="true" data-username="<?php echo $userData['firstname']; ?>" data-userid="<?php echo $userData['id']; ?>"><img class="iconLike" src="assets/icon_likes-toggled.svg" alt="Number of likes"  style="width: 23px"/></a>
                                <?php endif; ?>
                                <span class="likeCount"><?php echo count($allLikes); ?></span>
                            </div>
                            <ul class="hoverBubble">
                                <?php foreach($allLikes as $like): ?>
                                    <?php if($like['user_id'] == $sessionId): ?>
                                        <li data-likeuserid="current-user"><?php echo htmlspecialchars($like['firstname']) ?></li>
                                    <?php else: ?>
                                        <li data-likeuserid="<?php echo $like['user_id']; ?>"><?php echo htmlspecialchars($like['firstname']); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="post__foot__comments">
                            <a href="#"><img src="assets/icon_comments.svg" alt="Number of comments"/></a>
                            <span class="commentCount"><?php echo count($allComments); ?></span>
                        </div>
                    </div>

                <!-- Comment section -->
                    <div class="post__comments detail__comments__form">
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

                            <?php  endforeach;  ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
        </section>

        <?php include "navbar.php" ?>

        <script src="javascript/app.js"></script>
        <script src="ajax/savelike.js"></script>
</body>
</html>