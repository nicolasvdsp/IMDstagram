<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");

    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM users");
    $statement->execute();
    $user = $statement->fetch();

    echo $user["firstname"];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <title>Foodstagram</title>
</head>
<body>

    
</body>
</html>