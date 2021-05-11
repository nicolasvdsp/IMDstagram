<?php 

class Post {
    public function getAllPosts(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM posts");
        $statement->execute();
        $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $allPosts;
    }

    public function getUserdataByPostId($postId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users INNER JOIN posts ON users.id = posts.users_id WHERE posts.id = :postId");
        $statement->bindValue(':postId', $postId);
        $statement->execute();
        $username = $statement->fetch(PDO::FETCH_ASSOC);
        return $username;
    }


}