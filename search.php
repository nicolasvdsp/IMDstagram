<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Post.php");
include_once(__DIR__ . "/classes/Search.php");


ini_set('display_errors', true);

//database connectie
$conn = Db::getConnection();

//Sessie starten
session_start();
if (!isset($_SESSION['id'])) {
  header('location: login.php');
} else {
  $sessionId = $_SESSION['id'];
}

$search = new Search();

if (!empty($_GET)) {
  $user = $search->searchUser($_GET['q']);
  $tag = $search->searchTag($_GET['q']);
  $location = $search->searchLocation($_GET['q']);
}

$p = new Post;
$allPosts = $p->getAllPosts()

?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

<body>

  <div class="header">
    <a href="index.php"><img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram" /></a>
    <a href="search.php"><img class="search" src="./assets/icon_search.svg" alt="Search button" /></a>
    <a href="followers.php">+ friends</a>
  </div>

  <section class="posts">
    <!--Zoekformulier-->
    <form action="" method="GET">
      <input type="search" name="q" placeholder="Search ..." />
      <input type="submit" value="Enter" />
    </form>
  </section>

  <!--Search tabs-->
  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Accounts')">Accounts</button>
    <button class="tablinks" onclick="openCity(event, 'Tags')">#Tags</button>
    <button class="tablinks" onclick="openCity(event, 'Locations')">Locations</button>
  </div>

  <!--Accounts-->
  <div id="Accounts" class="tabcontent">
    <ul>
      <?php if (isset($user)) : ?>
        <?php foreach ($user as $account) { ?>
          <li style="font-size: 20px;"><a href="profile.php?id=<?php echo $post['users_id']; ?>" ><img style="width: 50px; height:50px; border-radius: 100%;" src="<?php echo $account['profile_picture']; ?>" alt="avatar">
              <?= $account['firstname'] . ' ' . $account['lastname'] ?></a><br><br></li>
        <?php } ?>
      <?php endif; ?>
    </ul>

  </div>

  <!--Tags-->
  <div id="Tags" class="tabcontent">
    <ul>
      <?php if (isset($tag)) : ?>
        <?php foreach ($tag as $tags) { ?>
          <li><a href="tags.php?id=<?php echo $p->getTagsByPostId($post['id'])['tags_id'] ?>">#<?= $tags['tags_name'] ?></a><br><br></li>
        <?php } ?>
      <?php endif; ?>
    </ul>
  </div>


  <!--Location-->
  <div id="Locations" class="tabcontent">
    <ul>
      <?php if (isset($location)) : ?>
        <?php foreach ($location as $locations) { ?>
          <li><a href="index.php"><img src="./assets/icon_location.png" alt="location-icon"><?= $locations['upload_location'] ?></a><br><br></li>
        <?php } ?>
      <?php endif; ?>
    </ul>

  </div>

  <script src="script.js"></script>


</body>

</html>