<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__. "/classes/User.php");
include_once(__DIR__ . "/classes/Post.php");
//include_once(__DIR__ . "/classes/Search.php");


ini_set('display_errors', true);

//database connectie
$conn = Db::getConnection();

//Sessie starten
session_start();
if(!isset($_SESSION['id'])) {
    header('location: login.php');
} else{
    $sessionId = $_SESSION['id'];
}



?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<body>

<div class="header">
    <a href="index.php"><img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/></a>
</div>

<section class="posts">
    <form method="GET">
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
<?php 
if (isset($_GET['q']) and !empty($_GET['q'])) {
	$q = htmlspecialchars($_GET['q']);
  $search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
  upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE firstname LIKE "%'.$q.'%" OR lastname LIKE "%'.$q.'%" OR tag LIKE "%'.$q.'%" OR upload_location LIKE "%'.$q.'%"');

  while($search_user = $search_result->fetch()) { ?>
    <li style="font-size: 20px;"><a href="index.php" ><img style="width: 50px; height:50px; border-radius: 100%;" src="<?php echo $search_user['profile_picture']; ?>" alt="avatar">
      <?=$search_user['firstname'].' '.$search_user['lastname']?></a><br><br></li>
  <?php }} ?>
</ul> 

</div>

<!--Tags-->
<div id="Tags" class="tabcontent">
  <ul>
  <?php 

  if (isset($_GET['q']) and !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    $search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
    upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE firstname LIKE "%'.$q.'%" OR lastname LIKE "%'.$q.'%" OR tag LIKE "%'.$q.'%" OR upload_location LIKE "%'.$q.'%"');

    while($search_user = $search_result->fetch()) { ?>
    <li>#<?=$search_user['tag']?><br><br></li>

  <?php }} ?>
  </ul> 
</div>


<!--Location-->
<div id="Locations" class="tabcontent">
  <ul>
  <?php 

  if (isset($_GET['q']) and !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    $search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
    upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE firstname LIKE "%'.$q.'%" OR lastname LIKE "%'.$q.'%" OR tag LIKE "%'.$q.'%" OR upload_location LIKE "%'.$q.'%"');

    while($search_user = $search_result->fetch()) { ?>
    <li><?=$search_user['upload_location']?><br><br></li>
  
  <?php }} ?>

  </ul> 

</div>

<script src="script.js"></script>

   
</body>
</html> 