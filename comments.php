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
  
    <?php foreach($comments as $comment): ?>      
        <article class="comment">
            <span class="comment__username"><?php echo $comment['username']; ?></span>
            <p class="comment__text"><?php echo $comment['text']; ?></p>
        </article>
    <?php endforeach; ?>
  
</body>

</html>