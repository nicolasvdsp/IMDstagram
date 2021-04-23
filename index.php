<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");

    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM post");
    $statement->execute();
    $user = $statement->fetch();

    echo $user["text"];
    echo $user["image"];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Dinkstagram</title>
</head>
<body>
    
    <nav class="navbar">
        <a class="navbar__btn" href="#">home</a>
        <a class="navbar__btn" href="#">new</a>
        <a class="navbar__btn" href="#">settings</a>
    
    </nav>
    
</body>
</html>