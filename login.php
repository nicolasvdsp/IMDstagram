<?php 
    ini_set('display_errors', true);

    


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
    <div class="login">
        <img class="logo--login" src="assets/logo_dinkstagram.svg" alt="Logo Dinkstagram">
        <form action="" method="GET">
            <div class="form__input">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="vjtony@w&m.be">
            </div> 
            <div class="form__input">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="• • • • • • • • • •">
            </div> 
            <input class="btn--login" type="submit" value="Dink in">
        </form>
        <a class="login-register">Don't have an account yet? <span>Subscribe here!</span></a>
    </div>
</body>
</html>