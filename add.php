<?php 
    ini_set('display_errors', true);
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Post.php");

    session_start();
    if(!isset($_SESSION['id'])) {
        header('location: login.php');
    } else{
        $sessionId = $_SESSION['id'];
        $userData = User::getUserDataFromId($sessionId);
    }

    if(!empty($_POST)) {
        $p = new Post;

        $file = $_FILES['postPicture'];
        
        $fileName = $_FILES['postPicture']['name'];
        $fileTmpName = $_FILES['postPicture']['tmp_name'];
        $fileSize = $_FILES['postPicture']['size'];
        $fileError = $_FILES['postPicture']['error'];
        $fileError = $_FILES['postPicture']['type'];
        
        $fileTarget = 'post_pictures/' . basename($fileName);
        
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
                $postPicture = basename($fileName);
                $postDescription = $_POST['postDescription'];
                $postUsers_id = $userData['id'];
                $postLocation = $_POST['location'];
                $postTag = $_POST['tags'];
                $p->createPost($postPicture, $postDescription, $postTag, $postLocation, $postUsers_id);
            }
       }   
    }
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="image/svg" href="assets/favicon.svg">
    <title>Add a post</title>
</head>
<body>
        <div class="header">
            <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
            <p style="font-weight: bold;">Create a new post</p>
        </div>

        <section class="posts">
            <form action="" method="POST" enctype="multipart/form-data">
                <input class="post__addImage .file" type="file" id="postPicture" name="postPicture" class="post__addImage" href="#">
    
                <div class="form__input">
                    <label for="postDescription">Beschrijving</label>
                    <?php if(!empty($_POST)): ?>
                        <div class="grow-wrap">
                            <textarea id="postDescription" name="postDescription" placeholder="Vertel over je dag." onInput="this.parentNode.dataset.replicatedValue = this.value"><?php  echo htmlspecialchars($_POST['postDescription']); ?></textarea>
                        </div>    
                    <?php else: ?>
                        <div class="grow-wrap">
                            <textarea id="postDescription" name="postDescription" placeholder="Vertel over je dag." onInput="this.parentNode.dataset.replicatedValue = this.value"></textarea>
                        </div>
                    <?php endif; ?>
                </div> 

                <div class="form__input">
                    <label for="tags">Tags</label>
                    <?php if(!empty($_POST)): ?>
                        <input type="text" id="tags" name="tags" value="<?php echo htmlspecialchars($_POST['tags']); ?>" placeholder="Voeg trendy tags toe">
                    <?php else: ?>
                        <input type="text" id="tags" name="tags" placeholder="voeg trendy tags toe">
                    <?php endif; ?>
                </div> 

                <div class="form__input">
                    <label for="location">Locatie</label>
                    <?php if(!empty($_POST)): ?>
                        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($_POST['location']); ?>" placeholder="Voeg je locatie toe">
                    <?php else: ?>
                        <input type="text" id="location" name="location" placeholder="voeg je locatie toe">
                    <?php endif; ?>
                </div> 

                <input class="btn--login" type="submit" value="Post je dinkbericht" name="createPost">
        
            </form>
        </section>
    
        <nav class="navbar">
            <a class="navbar__btn" href="index.php">Home</a>
            <a class="navbar__btn" href="add.php">Add</a>
            <a class="navbar__btn" href="usersettings.php">User</a>
            
        </nav>
    
</body>
</html>