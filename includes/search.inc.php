<?php
//session_start();

include_once(__DIR__ ."/classes/Post.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/User.php");

$conn = Db::getConnection();

if ($_SESSION['email']  == '') {
    header ("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>SEARCH</h1>
         <!--SEARCH-->
         <form class="search" method="POST">
            <label>Search</label>
            <input type="text" name="search">
            <input type="submit" name="submit">
        </form>
  
</body>
</html>