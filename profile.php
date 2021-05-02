<?php
include_once(__DIR__ . "/classes/Db.php");
$id = $_GET['id'];
//echo $id;

$conn = Db::getConnection();

$statement = $conn->prepare("SELECT * FROM users WHERE id = $id");
$statement->execute();
$user = $statement->fetch();

$statement = $conn->prepare("SELECT * FROM post, users WHERE post.users_id = users.id");

$statement->execute();
$posts = $statement->fetchAll();
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
  <div class="header">
    <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram" />
    <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button" /></a>
  </div>

  <div class="posts">
    <div class="post__head">
      <img class="post__userImage" src="<?php echo $user['profile_picture'] ?>" alt="Profile Picture" />
      <p class="post__userName"><?php echo $user['firstname']; ?></p>
      <p class="post__userName"><?php echo $user['lastname']; ?></p>
    </div>

    <p class="user_bio"><?php echo $user['bio']; ?></p>
    <a class="user_website"><?php echo $user['website']; ?></a>

    <div class="post_collection">
      <?php foreach ($posts as $post) : ?>
        <img class="post__image" src="<?php echo $post['image']; ?>" alt="Post Image" />
      <?php endforeach; ?>
    </div>
  </div>

  <nav class="navbar">
    <a class="navbar__btn" href="#">Home</a>
    <a class="navbar__btn" href="add.php">Add</a>
    <a class="navbar__btn" href="#">User</a>
  </nav>
  
</body>

</html>