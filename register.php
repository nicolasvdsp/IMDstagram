<?php
    ini_set('display_errors', true);
    //include User and Database class
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");


    if (!empty($_POST)){
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->register();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<!--HIER WORDEN DE ERRORS IN DE DIV GETOOND-->
<div class="errorMessage">
    <?php
        if(isset($error)): ?>
        <div class="registerError" role="alert">
            <p>
                <?php echo $error; ?>
            </p>
        </div>
        <?php endif; ?>
</div>


<!--REGISTRATION FORMULIER-->
<div class="login">
        <img class="logo--login" src="assets/logo_dinkstagram.svg" alt="Logo Dinkstagram">
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
            <input class="btn--login" type="submit" value="Dink in">
        </form>
        <a href="register.php" class="login-register" href="register.php">You already have an account? <span>Dink in here!</span></a>
    </div>


</body>
</html>