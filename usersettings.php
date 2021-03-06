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
    }
    if(!empty($_POST['submitProfilePicture'])) {
        $file = $_FILES['profilePicture'];
        
        $fileName = $_FILES['profilePicture']['name'];
        $fileTmpName = $_FILES['profilePicture']['tmp_name'];
        $fileSize = $_FILES['profilePicture']['size'];
        $fileError = $_FILES['profilePicture']['error'];
        $fileError = $_FILES['profilePicture']['type'];
        
        $fileTarget = 'profile_pictures/' . basename($fileName);
        
        $fileExtention = strtolower(pathinfo($fileTarget,PATHINFO_EXTENSION));
        
        $check = getimagesize($fileTmpName);
        //Checks if file is an image
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $errorImage = 'Uw geupload bestand is geen afbeelding.';
            $uploadOk = 0;
        }

        //Checks if file already exists
        if(file_exists($fileTarget)) {
            $uploadOk = 1;
        }

        //Checks the file-size
        if($fileSize > 2097152) {
            $errorSize = 'Je afbeelding is te groot, probeer een kleiner formaat.';
            $uploadOk = 0;
        }

        //Allows only JPG, JPEG, PNG and GIF format
       if($fileExtention != 'jpg' && $fileExtention != 'jpeg' && $fileExtention != 'png' && $fileExtention != 'gif' && !empty($fileName)) {
           $errorExtention = 'Dit bestandstype wordt niet ondersteund. Probeer een jpg, png of gif.';
           $uploadOk = 0;
       }

       //Uploads file if no errors occured
       if($uploadOk === 1) {
            if(move_uploaded_file($fileTmpName, $fileTarget)) {
                $profilePicture = basename($fileName);
                $user->setProfilePicture($profilePicture);
                $user->uploadProfilePicture($profilePicture, $sessionId);
            }
       }
    }
    
    if(!empty($_POST['submitUpdates'])) {
        try {
            $user->setFirstName($firstname = $_POST['updateFirstname']);
            $user->setLastname($_POST['updateLastname']);
            $user->setEmail($_POST['updateEmail']);
            $user->setBiography($_POST['updateBiography']);
            $user->setUserId($sessionId);
            $user->updateDetails();
            
            if(!empty($_POST['updatePassword'])){
                $user->updatePassword($_POST['updatePassword'], $sessionId);
            }
            
            $userData = User::getUserDataFromId($sessionId);
            
            $feedbackSuccess = "Wijzig-dinken opgeslagen";
            
            } catch (\Throwable $th) {
                $error = $th->getMessage();
            }
    }

    $user = new User();
    $user->updateFirstname($_POST['updateFirstname'], $sessionId);
    $user->updateLastname($_POST['updateLastname'], $sessionId);
    $user->updateEmail($_POST['updateEmail'], $sessionId);
    $user->updateBiography($_POST['updateBiography'], $sessionId);
    // $user->updateEmail($_POST['updateEmail']);

    $userData = User::getUserDataFromId($sessionId);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/temporary.css">
    <link rel="shortcut icon" type="image/svg" href="assets/favicon.svg">
</head>

<body>
    
    <?php include "header.php" ?>

    <div class="login">
        <form action="" method="POST" enctype="multipart/form-data" >
            <div class="form__input">
                <label for="profilePicture">Profiel foto</label>
                <img class="form__image" src="profile_pictures/<?php echo $userData['profile_picture']; ?>" alt="Profile picture">
                <input type="file" id="profilePicture" name="profilePicture">
                <input class="btn--login"  type="submit" name="submitProfilePicture" value="Upload profielfoto">
            </div> 
        </form>


        <form action="" method="POST">
            <div class="form__input input--large">
                <label for="biography">Biografie</label>
                <div class="grow-wrap">
                    <textarea id="biography" name="updateBiography" placeholder="Schrijf hier iets over jezelf." onInput="this.parentNode.dataset.replicatedValue = this.value"><?php  echo htmlspecialchars($userData['bio']); ?></textarea>
                </div>    
            </div> 
            <div class="form__input">
                <label for="firstName">Voornaam</label>
                <input type="text" id="firstName" name="updateFirstname" value="<?php echo htmlspecialchars($userData['firstname']); ?>" placeholder="Vul je voornaam in">
            </div> 
            <div class="form__input">
                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name="updateLastname" value="<?php echo htmlspecialchars($userData['lastname']); ?>" placeholder="Vul je achternaam in">
            </div> 
            <div class="form__input">
                <label for="email">Email</label>
                <input type="text" id="email" name="updateEmail" value="<?php echo htmlspecialchars($userData['email']); ?>" placeholder="Vul je email-adres in">
            </div> 
            <div class="form__input">
                <label for="password">Password</label>
                <input type="text" id="password" name="updatePassword" placeholder="??? ??? ??? ??? ??? ??? ??? ??? ??? ???">
            </div>
            <?php if(isset($feedbackSuccess)): ?>
                <p class="feedback success"><?php echo $feedbackSuccess; ?></p>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <p class="feedback fail"><?php echo $error; ?></p>
            <?php endif; ?>
            <input class="btn--login" type="submit" value="Wijzigingen opslaan" name="submitUpdates">
        </form>
        <a href="logout.php" class="login-register"> <span>Uitloggen</span></a>
    </div>

    <?php include "navbar.php" ?>
</body>

</html>