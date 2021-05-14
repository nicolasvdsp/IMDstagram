<?php

ini_set('display_errors', true);
include_once(__DIR__ . "/classes/Db.php");

//database connectie
$conn = Db::getConnection();

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


<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">Accounts</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">#Tags</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Locations</button>
</div>

<div id="London" class="tabcontent">
  <h3>Accounts</h3>
  <ul>
<?php 

if (isset($_GET['q']) and !empty($_GET['q'])) {
	$q = htmlspecialchars($_GET['q']);
  $search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
  upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE firstname LIKE "%'.$q.'%" OR lastname LIKE "%'.$q.'%" OR tag LIKE "%'.$q.'%" OR upload_location LIKE "%'.$q.'%"');

  while($search_user = $search_result->fetch()) { ?>
    <li style="font-size: 20px;"><a href="index.php"><img style="width: 50px; height:50px; border-radius: 100%;" src="<?php echo $search_user['profile_picture']; ?>" alt="avatar">
      <?=$search_user['firstname'].' '.$search_user['lastname']?></a><br><br></li>
  <?php }} ?>
</ul> 
</div>

<div id="Paris" class="tabcontent">
  <h3>#tags</h3>

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

<div id="Tokyo" class="tabcontent">
  <h3>Locations</h3>
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