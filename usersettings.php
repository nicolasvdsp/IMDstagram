<?php 

    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");

    session_start();
    if(!isset($_SESSION['id'])) {
        header('location: login.php');
    } else{
        $sessionId = $_SESSION['id'];
    }
    
    if(!empty($_POST)) {
        $userData = User::getUserDataFromId($sessionId);
        var_dump($userData);

        $user = new User();
        $user->updateFirstname($_POST['updateFirstname'], $sessionId);
        // $user->updateLastname($_POST['updateLastname']);
        // $user->updateEmail($_POST['updateEmail']);

        
        
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="header">
        <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
        <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button"/></a>
    </div>

    <div class="login">
        <form action="" method="POST">
            <div class="form__input">
                <label for="firstName">First name</label>
                <input type="text" id="firstName" name="updateFirstname" placeholder="<?php echo $userData['firstname']; ?>">
            </div> 
            <div class="form__input">
                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name="updateLastname" placeholder="<?php echo $userData['lastname']; ?>">
            </div> 
            <div class="form__input">
                <label for="email">Email</label>
                <input type="text" id="email" name="updateEmail" placeholder="<?php echo $userData['email']; ?>">
            </div> 
            <div class="form__input">
                <label for="password">Password</label>
                <input type="text" id="password" name="updatePassword" placeholder="• • • • • • • • • •">
            </div>
            <input class="btn--login" type="submit" value="Wijzigingen opslaan">
        </form>
        <a href="register.php" class="login-register" href="register.php">You already have an account? <span>Dink in here!</span></a>
    </div>

    <nav class="navbar">
            <a class="navbar__btn" href="index.php">Home</a>
            <a class="navbar__btn" href="add.php">Add</a>
            <a class="navbar__btn" href="usersettings.php">User</a>
            
        </nav>
</body>
</html>