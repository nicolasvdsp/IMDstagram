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
    $statement = $conn->prepare("SELECT * FROM post ORDER BY created_time DESC limit 20");
    $statement->execute();
    $posts = $statement->fetchAll();

    foreach($posts as $post){
        // echo $post['text'];
        // echo "<img class='post__image' src='". $post['image'] ."' alt='post image'/>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    

    <h1>Post</h1>
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

</body>
</html>