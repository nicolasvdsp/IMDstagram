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

$allusers = Followers::Users();

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
                    <li> <?php echo $users['firstname'] . ' ' . $users['lastname'] ?> <button>follow</button>
                    </li>
                <?php } ?>
            </ul>
        </section>

        <section>

            <div class="myFollowers">
                <h1>Volgers</h1>
                <li>naam + achternaam</li>
            </div>

            <div class="myFollowing">
                <h2>Volgend</h2>
                <li>naam + achternaam</li>
            </div>

            <br><br>

            <h1>Aantal vriendschappen:
                <?php
                //Als je buddies hebt, komt deze in je lijst te staan
                $countUsers = Followers::countUsers();
                echo "$countUsers ";
                ?>
            </h1>
        </section>

    </div>





    <nav class="navbar">
        <a class="navbar__btn" href="index.php">Home</a>
        <a class="navbar__btn" href="add.php">Add</a>
        <a class="navbar__btn" href="usersettings.php">User</a>

    </nav>



</body>

</html>