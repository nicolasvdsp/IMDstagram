<?php 

    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");
    
    if(!empty($_POST)) {
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);



        if($user->canLogin($_POST['email'], $_POST['password'])) {
            $id = User::getIdByEmail($user->getEmail());
            $user->startSession($id);
            
            
        } else{
            echo "kaas";
            $errorLogin = "Email en wachtwoord komen niet overeen";
        }
        
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
    <link rel="shortcut icon" type="image/svg" href="assets/favicon.svg">
</head>
<body>
    <div class="login">
        <img class="logo--login" src="assets/logo_dinkstagram.svg" alt="Logo Dinkstagram">
        <form action="" method="POST">
            <div class="form__input">
                <label for="email">Email</label>
                <?php if(!empty($_POST)): ?>
                    <input type="text" id="email" name="email" placeholder="vjtony@w&m.be" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                <?php else: ?>
                    <input type="text" id="email" name="email" placeholder="vjtony@w&m.be">
                <?php endif; ?>
            </div> 
            <div class="form__input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="• • • • • • • • • •">
            </div> 
            <?php if(isset($errorLogin)): ?>
                <p class="fail"><?php echo $errorLogin; ?></p>
            <?php endif; ?>

            <input class="btn--login" type="submit" value="Dink in">
        </form>
        <a href="register.php" class="login-register" href="register.php">Heb je nog geen account? <span>Registreer hier!</span></a>
    </div>
</body>
</html>