<?php
ini_set('display_errors', true);
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Followers.php");

session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
} else {
    $sessionId = $_SESSION['id'];
    $userData = User::getUserDataFromId($sessionId);
}

$allusers = Friends::Users();
$following = Friends::Following($sessionId);
$followers = Friends::Followers($sessionId);
$request = Friends::SendRequest($sessionId);
var_dump($request);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Followers</title>
</head>

<body>

    <div class="header">
        <a href="index.php"><img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram" /></a>
        <a href="search.php"><img class="search" src="./assets/icon_search.svg" alt="Search button" /></a>
        <a href="followers.php">+ friends</a>
    </div>
    <br><br>

    <div class="friends">
        <section>
            <h1>All users</h1>
            <ul>
                <?php
                foreach ($allusers as $users) { ?>
                    <li> <?php echo $users['firstname'] . ' ' . $users['lastname'] ?>
                        <form method="POST" action="<?php $_PHP_SELF ?>" class="btn">
                            <input type="hidden" id="id" name="id" value="<?php echo $users['id'] ?>">
                            <input type="submit" value="Follow" />
                        </form>
                    </li>
                <?php } ?>
            </ul>
        </section>



        <section>

            <div class="myFollowers">
                <h1>Followers</h1>
                <?php
                foreach ($followers as $follower) { ?>
                    <li> <?php echo $follower['firstname'] . ' ' . $follower['lastname'] ?>
                    </li>
                <?php } ?>

            </div>

            <div class="myFollowing">
                <h1>Following</h1>
                <?php
                foreach ($following as $follow) { ?>
                    <li> <?php echo $follow['firstname'] . ' ' . $follow['lastname'] ?>
                    </li>
                <?php } ?>
            </div>

            <br><br>


        </section>

    </div>





    <nav class="navbar">
        <a class="navbar__btn" href="index.php">Home</a>
        <a class="navbar__btn" href="add.php">Add</a>
        <a class="navbar__btn" href="usersettings.php">User</a>

    </nav>



</body>

</html>