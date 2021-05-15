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
    //echo $sessionId;
    $userData = User::getUserDataFromId($sessionId);
}

$usersId = $_GET['id'];
$userData = User::getUserDataFromId($usersId);
$posts = (new Post)->getAllPostsOfUser($usersId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dinkstagram</title>
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <?php include "header.php" ?>

  <div class="user__profile">
    <div class="user__content">
    <div class="user__head">
      <img class="post__userImage" src="profile_pictures/<?php echo $userData['profile_picture']; ?>" alt="Profile Picture" />
      <p class="user__userName"><?php echo $userData['firstname']; ?></p>
      <p class="user__lastName"><?php echo $userData['lastname']; ?></p>
    </div>

    <div class="user__information">
      <p class="user__bio"><?php echo $userData['bio']; ?></p>
      <a class="user__website"><?php echo $userData['website']; ?></a>
    </div>

    <?php if($sessionId === $usersId) : ?>
      <div class="user__self">
        <a class="user__btn" href="usersettings.php"> Settings</a>
        <a class="user__btn" href="logout.php">Logout</a>
      </div> 
    <?php endif; ?>
    
    <div class="post__collection">
      <?php foreach ($posts as $post) : ?>
        <img class="profile__image" src="post_pictures/<?php echo $post['image']; ?>" alt="Post Image" />
      <?php endforeach; ?>
    </div>
    </div>
    
  </div>

  <?php include "navbar.php" ?>
  
</body>

</html>