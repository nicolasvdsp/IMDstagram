<?php 
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/User.php");

    session_start();
    $sessionId = $_SESSION['id'];
    $userData = User::getUserDataFromId($sessionId);

    if(!empty($_POST)) {

        $comment = new Comment();
        //$_POST['postId'] komt van app.js lijn 22 formData.append("postId", postId); (het deel tussen aanhalingstekens)
        $comment->setPostId($_POST['postId']);
        $comment->setText($_POST['text']);
        $comment->setUserId($sessionId); //$_SESSION
        
        //save()
        $comment->saveComment();

        //success teruggeven
        $response = [
            'status' => 'success',
            'body' => htmlspecialchars($comment->getText()),
            'message' => 'Comment saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>