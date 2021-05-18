<?php
    include_once(__DIR__ . "/../classes/Like.php");
    include_once(__DIR__ . "/../classes/User.php");

    session_start();
    $sessionId = $_SESSION['id'];
    $userData = User::getUserDataFromId($sessionId);

    if(!empty($_POST)) {
        $like = new Like();
        $like->setPostId($_POST['postId']);
        $like->setUserId($sessionId);
        $like->setIsLiked($_POST['isLiked']);

        // save()
        if($like->getIsLiked() == "true"){
            $like->unlikePost();
        } else {
            $like->likePost();
        }

        // success teruggeven
        $response = [
            'status' => 'success',
            'body' => $like->getPostId(),
            'message' => 'Like added'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }