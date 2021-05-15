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

    //POST
    $conn = Db::getConnection();
<<<<<<< Updated upstream
    $statement = $conn->prepare("SELECT * FROM post");
    $statement->execute();
    $posts = $statement->fetchAll();

=======
    $statement = $conn->prepare("SELECT * FROM post ORDER BY created_time DESC limit 2");
    $statement->execute();
    $posts = $statement->fetchAll();

    foreach($posts as $post){

    }
>>>>>>> Stashed changes

    //LOAD MORE


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
            <a href="index.php"><img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/></a>
            <a href="search.php"><img class="search" src="./assets/icon_search.svg" alt="Search button"/></a>
        </div>
        <br><br>
        <div class="followers">
            <h1 style= "font-size: 50px;">14 volgers</h1>
        </div>

        <div class="following">
            <h1 style= "font-size: 50px;">3 volgend</h1>
        </div>



<<<<<<< Updated upstream



        <!--Post-->
        <section class="posts">
=======
        <form class="loadmore" action="POST">

        <section id="posts" class="posts">
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
        </section>
=======

        <input type="hidden" id="result_no" value="2">
        <input href="#" type="button" id="loadBtn" data-postid="1" value="Load More">

        </section>


        </form>
>>>>>>> Stashed changes
    
        <nav class="navbar">
            <a class="navbar__btn" href="index.php">Home</a>
            <a class="navbar__btn" href="add.php">Add</a>
            <a class="navbar__btn" href="usersettings.php">User</a>
            
        </nav>
    
    <!--AJAX CALL-->
    <script src="ajax/loadmore.js"></script>

</body>
</html>