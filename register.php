<?php
    ini_set('display_errors', true);
    //include User and Database class
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");


    if (!empty($_POST)){
        try{
            if($_POST['password'] === $_POST['passwordRepeat'] && !empty($_POST['password'])){
                $user = new User();
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->register();
                $id = User::getIdByEmail($user->getEmail());
                $user->startSession($id);

            } else {
                $errorPasswords = "Wachtwoorden komen niet overeen";
            }
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }
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
                <?php if(!empty($_POST)): ?>
                <input type="text" id="firstName" name="firstname" placeholder="Tony" value="<?php echo $_POST['firstname']; ?>">
                <?php else: ?>
                <input type="text" id="firstName" name="firstname" placeholder="Tony">
                <?php endif; ?>
            </div> 
            <div class="form__input">
                <label for="lastName">Last name</label>
                <?php if(!empty($_POST)): ?>
                <input type="text" id="lastname" name="lastname" placeholder="Miauwkes" value="<?php echo $_POST['lastname']; ?>">
                <?php else: ?>
                <input type="text" id="lastname" name="lastname" placeholder="Miauwkes">
                <?php endif; ?>
            </div> 
            <div class="form__input">
                <label for="email">Email</label>
                <?php if(!empty($_POST)): ?>
                <input type="text" id="email" name="email" placeholder="vjtony@w&m.be" value="<?php echo $_POST['email']; ?>">
                <?php else: ?>
                <input type="text" id="email" name="email" placeholder="vjtony@w&m.be">
                <?php endif; ?>
            </div> 
            <div class="form__input">
                <label for="password">Password</label>
                <div class="input--btn">
                    <input type="password" id="password" name="password"  class="password" placeholder="• • • • • • • • • •">
                    <a href="#" class="form__hideShow hideShow">Show</a>
                </div>
            </div> 
            <div class="form__input">
                <label for="passwordRepeat">Password repeat</label>
                <input type="password" id="passwordRepeat" name="passwordRepeat" class="passwordRep" placeholder="• • • • • • • • • •">
                <a href="#" class="form__hideShow hideShowRep">Show</a>
            </div> 
            <input class="btn--login" type="submit" value="Dink in">
        </form>
        <a href="login.php" class="login-register">You already have an account? <span>Dink in here!</span></a>
    </div>

<script src="javascript/app.js"></script>
</body>
</html>