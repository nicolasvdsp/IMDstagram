<?php

include_once(__DIR__ . "/Db.php");
include_once(__DIR__ . "/User.php");
//include_once(__DIR__ . "/Search.php");

$search = $_GET["search"];


   /* foreach($posts as $post){
        // echo $post['text'];
        // echo "<img class='post__image' src='". $post['image'] ."' alt='post image'/>";
    }

   /* if(isset($_POST["submit"])){
        $conn = Db::getConnection();
        $str = $_POST["search"];
        $sth = $conn->prepare("SELECT * FROM 'post' WHERE Name= ''$str");

      //  $sth->setFecthMode(PDO::FETCH_OBJ);
        $sth->execute();
    }
    
*/

//$search = Post::search(strtolower($_GET['search']));



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoekresultaten</title>
</head>
<body>
    <!--h5><?php //echo htmlspecialchars($_GET['search']); ?></h5-->


      <!--Navigatie-->  
        <a href="index.php">Terug naar home</a>
      <!--Zoekfunctie-->      
        <!--  <form action="search.php" method="POST">
        <label for="search">Search</label>
        <input type="text">
        <input type="submit">
        </form>   -->

      <!--Zoekresultaten--> 
      <section>
      <h1>Zoekresultaten</h1>  
       <div class="search_result">
        <p>Hier komen de zoekresultaten</p>
       
       </div> 
    
      </section>


</body>
</html>