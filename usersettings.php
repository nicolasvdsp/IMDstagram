<?php 

    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");

    session_start();
    if(!isset($_SESSION['id'])) {
        header('location: login.php');
    } else{
        $user = new User();
        $sessionId = $_SESSION['id'];
        $userData = User::getUserDataFromId($sessionId);
        echo "dag " . $userData['firstname'] . " met id: " . $_SESSION['id'];
    }
    if(!empty($_POST)) {

    if(isset($_FILES['profilePicture'])) {
        $file = $_FILES['profilePicture'];
        
        $fileName = $_FILES['profilePicture']['name'];
        $fileTmpName = $_FILES['profilePicture']['tmp_name'];
        $fileSize = $_FILES['profilePicture']['size'];
        $fileError = $_FILES['profilePicture']['error'];
        $fileError = $_FILES['profilePicture']['type'];
        $fileExtention = strtolower(end(explode('.', $fileName)));

        $allowedExtentions = [
            'jpg',
            'jpeg',
            'png',
            'gif'
        ];

        if(in_array($fileExtention, $allowedExtentions)) {
            if($fileSize < 2097152) {
                $profilePicture = uniqid('',true) . '.' . $fileExtention;
                $fileDestination = 'profile_pictures/' . $profilePicture;
                move_uploaded_file($fileTmpName, $fileDestination);
                $user->updateProfilePicture($profilePicture, $sessionId);
                header('refresh:0');
            } else {
                $errorFileSize = true;
            }
        } else{
            $errorExtention = true;
        }
    }
    
    // if(!empty($_POST)) {
        // var_dump($userData);
        
        $user->updateFirstname($_POST['updateFirstname'], $sessionId);
        $user->updateLastname($_POST['updateLastname'], $sessionId);
        $user->updateEmail($_POST['updateEmail'], $sessionId);
        $user->updateBiography($_POST['updateBiography'], $sessionId);
        $user->updatePassword($_POST['updatePassword'], $sessionId);
        // $user->updateEmail($_POST['updateEmail']);

        $userData = User::getUserDataFromId($sessionId);
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/temporary.css">
</head>
<body>
    <div class="header">
        <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
        <a href="#"><img class="search" src="./assets/icon_search.svg" alt="Search button"/></a>
    </div>

    <div class="login">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form__input">
                <label for="profilePicture">Profile picture</label>
                <img class="form__image" src="profile_pictures/<?php echo $profilePicture; ?>" alt="Profile picture">
                <input type="file" id="profilePicture" name="profilePicture">

            </div> 
            <div class="form__input input--large">
                <label for="biography">Biografie</label>
                <!-- <input type="text" id="biography" name="updateBiography" value="<?php echo $userData['bio']; ?>" placeholder="Schrijf hier iets over jezelf."> -->
                <!-- <textarea id="biography" name="updateBiography" placeholder="Schrijf hier iets over jezelf"><?php echo $userData['bio'] ?></textarea> -->
                <div class="grow-wrap">
                    <textarea id="biography" name="updateBiography" placeholder="Schrijf hier iets over jezelf." onInput="this.parentNode.dataset.replicatedValue = this.value"><?php  echo $userData['bio']; ?></textarea>
                </div>    
            </div> 
            <div class="form__input">
                <label for="firstName">First name</label>
                <input type="text" id="firstName" name="updateFirstname" value="<?php echo $userData['firstname'] ?>" placeholder="<?php echo $userData['firstname']; ?>">
            </div> 
            <div class="form__input">
                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name="updateLastname" value="<?php echo $userData['lastname'] ?>" placeholder="<?php echo $userData['lastname']; ?>">
            </div> 
            <div class="form__input">
                <label for="email">Email</label>
                <input type="text" id="email" name="updateEmail" value="<?php echo $userData['email'] ?>" placeholder="<?php echo $userData['email']; ?>">
            </div> 
            <div class="form__input">
                <label for="password">Password</label>
                <input type="text" id="password" name="updatePassword" placeholder="• • • • • • • • • •">
            </div>
            <input class="btn--login" type="submit" value="Wijzigingen opslaan">
        </form>
        <a href="login.php" class="login-register"> <span>Uitloggen</span></a>
    </div>

    <nav class="navbar">
            <a class="navbar__btn" href="index.php">Home</a>
            <a class="navbar__btn" href="add.php">Add</a>
            <a class="navbar__btn" href="usersettings.php">User</a>
            
        </nav>
</body>
</html>