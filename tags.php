<?php
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__. "/classes/User.php");


    session_start();
        if(!isset($_SESSION['id'])) {
            header('location: login.php');
        } else{
            $sessionId = $_SESSION['id'];
            //echo $sessionId;
            $userData = User::getUserDataFromId($sessionId);
        }
    
    $tagsId = $_GET['id'];
    $userData = User::getUserDataFromId($tags_id);

    //$posts = (new Post)->getTag($tagsId);

    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM posts INNER JOIN users ON posts.users_id = users.id INNER JOIN tags ON posts.tags_id = tags.id WHERE tags.id = :tagsId");
    $statement->bindValue(':tagsId', $tagsId);
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
    <link rel="stylesheet" type="text/css" href="css/temp.css">
    <title>Dinkstagram</title>
</head>
<body>
        <div class="header">
            <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
            <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button"/></a>
        </div>

        
        <p class="tags__head">Meer in deze #tag ?!</p>
        

        <section class="posts">
            <?php foreach($posts as $post): ?>
            <div class="post">
                
                <div class="post__head">
                    <img class="post__userImage" src="<?php echo $post["profile_picture"]; ?>" alt="Profile Picture"/>
                    <a href="profile.php?id=<?php echo $post['users_id']; ?>" class="post__userName" rel="author"><?php echo $post['firstname']; ?></a>
                </div>

                <div class="post__content">
                    <p class="post__text"><?php echo $post['text']; ?></p>
                    <img class="post__image" src="<?php echo $post['image']; ?>" alt="Post Image"/>
                    <a href="tags.php?id=<?php echo $post['tags_id']; ?>" class="post__tag"><?php echo '#'.$post['tags_name']; ?></a>
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