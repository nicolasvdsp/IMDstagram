<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php");
    
    session_start();
    if(!isset($_SESSION['id'])) {
        header('location: login.php');
    } else{
        $sessionId = $_SESSION['id'];
        $userData = User::getUserDataFromId($sessionId);
        echo "dag " . $userData['firstname'] . " met id: " . $_SESSION['id'];
    }

    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM post");
    $statement->execute();
    $posts = $statement->fetchAll();

    $statement = $conn->prepare("SELECT * FROM users");
    
    $statement->execute();
    $user = $statement->fetch();

    foreach($posts as $post){
        // echo $post['text'];
        // echo "<img class='post__image' src='". $post['image'] ."' alt='post image'/>";
    }

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
        <div class="header">
            <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
            <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button"/></a>
        </div>

        <section class="posts">
            <?php foreach($posts as $post): ?>
            <div class="post">
                
                <div class="post__head">
                    <img class="post__userImage" src="<?php echo $user["profile_picture"]; ?>" alt="Profile Picture"/>
                    <a href="profile.php?id=<?php echo $user['id']; ?>" class="post__userName" rel="author"><?php echo $user['firstname']; ?></a>
                    
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