<?php
   ini_set('display_errors', true);
   include_once(__DIR__ . "/classes/Db.php");
   include_once(__DIR__ . "/classes/User.php");
   include_once(__DIR__ . "/classes/Followers.php");

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers</title>
</head>
<body>
    
<form action="" method="POST">
   <button>Follow</button>
   <button>Unfollow</button>
</form>


<div class="myFollowers">
   <h1>Volgers</h1>
   <li>naam + achternaam</li>
</div>

<div class="myFollowing">
   <h2>Volgend</h2>
   <li>naam + achternaam</li>
</div>

<br><br>

<h1>Aantal vriendschappen:
    <?php
    //Als je buddies hebt, komt deze in je lijst te staan
    $countUsers = Followers::countUsers();
    echo "$countUsers ";    
    ?>   
</h1>



</body>
</html>