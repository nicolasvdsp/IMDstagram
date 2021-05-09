<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__. "/classes/User.php");
//echo $id;

$conn = Db::getConnection();

$users_id = $_GET['id'];
$userData = User::getUserDataFromId($users_id);

$statement = $conn->prepare("SELECT * FROM post WHERE users_id = :id");
$statement->bindValue(':id', $users_id);
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
  <link rel="stylesheet" type="text/css" href="css/temp.css">
</head>

<body>
  <div class="header">
    <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram" />
    <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button" /></a>
  </div>

  <div class="user__profile">
    <div class="user__content">
    <div class="user__head">
      <img class="post__userImage" src="<?php echo $userData['profile_picture'] ?>" alt="Profile Picture" />
      <p class="user__userName"><?php echo $userData['firstname']; ?></p>
      <p class="user__lastName"><?php echo $userData['lastname']; ?></p>
    </div>

    <div class="user__information">
      <p class="user__bio"><?php echo $userData['bio']; ?></p>
      <a class="user__website"><?php echo $userData['website']; ?></a>
    </div>
    
    <div class="post__collection">
      <?php foreach ($posts as $post) : ?>
        <img class="profile__image" src="<?php echo $post['image']; ?>" alt="Post Image" />
      <?php endforeach; ?>
    </div>
    </div>
    
  </div>

  <nav class="navbar">
    <a class="navbar__btn" href="#">Home</a>
    <a class="navbar__btn" href="add.php">Add</a>
    <a class="navbar__btn" href="#">User</a>
  </nav>
  
</body>

</html>