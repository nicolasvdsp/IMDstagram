<?php 
ini_set('display_errors', true);
include_once(__DIR__ . "/classes/Db.php");

//database connectie
$conn = Db::getConnection();
//$names = $conn->query('SELECT firstname, lastname, profile_picture, bio FROM users where firstname = "a"');


//Zoekfunctie
/*if (isset($_GET['q']) and !empty($_GET['q'])) {
	$q = htmlspecialchars($_GET['q']);*/
//	$names = $conn->query('SELECT firstname, lastname, profile_picture, bio FROM users WHERE firstname LIKE "%'.$q.'%"  OR lastname LIKE "%'.$q.'%"');
  //$names = $conn->query("SELECT users.firstname, users.lastname, post.tag, post.upload_location FROM users  JOIN post ON users.id = post.users_id WHERE firstname LIKE 'maryam' OR lastname LIKE 'maryam' OR tag LIKE 'maryam' OR upload_location LIKE 'maryam'");

 // $names = $conn->query("SELECT * FROM users NATURAL JOIN post LIKE 'fons'");

 //$search_result = $conn->query('SELECT * FROM users FULL JOIN post WHERE firstname 
 //LIKE "%'.$q.'%" OR lastname LIKE "%'.$q.'%" OR tag LIKE "%'.$q.'%" OR upload_location LIKE "%'.$q.'%"');

  //Resultaat niet gevonden }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Search</title>
</head>
<body>
        <div class="header">
          <a href="index.php"><img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/></a>
        </div>
 <section class="posts">		

<form method="GET">
	<input type="search" name="q" placeholder="Search ..." />
	<input type="submit" value="Enter" />
</form>
<br><br>

<ul>

<?php 

if (isset($_GET['q']) and !empty($_GET['q'])) {
	$q = htmlspecialchars($_GET['q']);
$search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, null as tag, null as 
upload_location from users union select null as uid, null as firstname, null as lastname, tag, upload_location from post ) AS t WHERE firstname LIKE "%'.$q.'%" OR lastname LIKE "%'.$q.'%" OR tag LIKE "%'.$q.'%" OR upload_location LIKE "%'.$q.'%"');




while($search_user = $search_result->fetch()) { ?>


	<li style="font-size: 20px;"><a href="index.php"><img style="width: 50px; height:50px; border-radius: 100%;" src="<?php echo $search_user['profile_picture']; ?>" alt="avatar">
    <?=$search_user['firstname'].' '.$search_user['lastname']?></a><br><br></li>

  <li>#<?=$search_user['tag']?><br><br></li>
  <li>Location: <?=$search_user['upload_location']?><br><br></li>
  <!--Tags-->  
 
<?php }} ?>




</ul> 


   </section>
        <nav class="navbar">
            <a class="navbar__btn" href="index.php">Home</a>
            <a class="navbar__btn" href="add.php">Add</a>
            <a class="navbar__btn" href="usersettings.php">User</a>
        </nav>
    
</body>
