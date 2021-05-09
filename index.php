<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php");
   // include_once(__DIR__ . "/classes/Search.php");

    session_start();
    if(!isset($_SESSION['id'])) {
        header('location: login.php');
    } else{
        $sessionId = $_SESSION['id'];
        $userData = User::getUserDataFromId($sessionId);
        //echo "dag " . $userData['firstname'] . " met id: " . $_SESSION['id'];
    }

    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM post");
    $statement->execute();
    $posts = $statement->fetchAll();





   
?>


<!DOCTYPE html>
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
        <div class="header">
            <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
            <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button"/></a>
        </div>
        <br><br>
        <div class="followers">
            <h1>14 volgers</h1>
        </div>

        <div class="following">
            <h1>3 volgend</h1>
        </div>



  
        <!--Zoekfunctie/ SEARCH FUNCTION-->      
      <form action="index.php" method="POST">
            <label for="search">Search</label>
            <input type="text" name="search">
            <input type="submit" name="submit-search" value="Zoeken">
      </form>   

       <!--Zoekresultaten/ SEARCH RESULTS--> 
        
       <?php

    $conn = Db::getConnection();
    if (isset($_POST["submit-search"])) {
        $str = $_POST["search"];
        $sth = $conn->prepare("SELECT * FROM `users` WHERE firstname = '$str'");

        
        $userData = User::getUserDataFromId($sessionId);
        echo "dag " . $userData['firstname'] . " met id: " . $_SESSION['id'];

        $sth->setFetchMode(PDO:: FETCH_OBJ);
        $sth -> execute();

        if($row = $sth->fetch())
	    {
		?>
		<br><br><br>
		<table>
			<tr>
				<th>Resultaten:</th>

			</tr>
			<tr>
				<td><a href=""><?php echo $row->firstname; ?></a></td>
				<td><a href=""><?php echo $row->lastname; ?></td>

			</tr>

            <tr>
                <td><a href=""><?php echo $row->date_of_birth; ?></td>
				<td><a href=""><?php echo $row->bio; ?></td>
			</tr>


		</table>
<?php 
	}
		else{
			echo "No results found";
		}

    }

?>




        <!--Post-->
        <section class="posts">
            <?php foreach($posts as $post): ?>
            <div class="post">
                <div class="post__head">
                    <img class="post__userImage" src="assets/cesarAlien.jpg" alt="Profile Picture"/>
                    <a class="post__userName" rel="author">Fons</a>
                </div>
                <div class="post__content">
                    <p class="post__text"><?php echo $post['text']; ?></p>
                    <img class="post__image" src="<?php echo $post['image']; ?>" alt="Post Image"/>
                </div>
                <div class="post__foot">
                    <div class="post__likes">
                        <a href="#"><img src="assets/icon_likes.svg" alt="Number of likes"/></a>
                        <span>5</span>
                    </div>
                    <div class="post__comments">
                        <a href="#"><img src="assets/icon_comments.svg" alt="Number of comments"/></a>
                        <span>5</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    
        <nav class="navbar">
            <a class="navbar__btn" href="index.php">Home</a>
            <a class="navbar__btn" href="add.php">Add</a>
            <a class="navbar__btn" href="usersettings.php">User</a>
            
        </nav>
    
</body>
</html>