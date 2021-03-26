<?php

//DE NODIGE CLASSES INCLUDEN
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");


//ALS DE POSTS NIET LEEG ZIJN, SPREKEN WE DE SETTERS AAN
if (empty($_POST)){

echo"GRAPJAS";

  /*  try{
      $user = new User();
      $user->setFullname($_POST['fullname']);
      $user->setUsername($_POST['username']);
      $user->setEmail($_POST['email']);
      $user->setPassword($_POST['password']);
    }*/
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
<div class="registration">
    <form action="" method="POST">
        <input name= "fullname" id="fullname" type="text" placeholder="Full Name" value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname']; ?>"><br>
        <input name= "username" id="email" type="text" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>"><br>
        <input name= "email" id="email" type="text" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"><br>
        <input name= "password" id="password" type="text" placeholder="Password" value=""><br>
        <button type="submit" name="submit">Register</button>
    </form>
</div>

<!--LOGIN INSTELLINGEN-->
<div class="loginSettings">
    <!--AL EEN ACCOUNT?-->
    <p>Already an account? <a href="login.php">Login</a></p>

</div>





</body>
</html>