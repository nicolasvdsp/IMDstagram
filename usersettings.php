<?php 

    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");
    
    if(!empty($_POST)) {
        $user = new User();
        $user->updateFirstname($_POST['firstname']);
        $user->updateLastname($_POST['lastname']);
        $user->updateEmail($_POST['email']);

        // if($user->canLogin($_POST['email'], $_POST['password'])) {
        //     $user->startSession($_POST['email']);
            
        // } else{
        //     echo "kaas";
        //     $errorLogin = "Email en wachtwoord komen niet overeen";
        // }
        
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
                <input type="text" id="firstName" name="firstname" placeholder="Tony">
            </div> 
            <div class="form__input">
                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name="lastname" placeholder="Miauwkes">
            </div> 
            <div class="form__input">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="vjtony@w&m.be">
            </div> 
            <div class="form__input">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="• • • • • • • • • •">
            </div> 
            <div class="form__input">
                <label for="passwordRepeat">Password repeat</label>
                <input type="text" id="passwordRepeat" name="passwordRepeat" placeholder="• • • • • • • • • •">
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