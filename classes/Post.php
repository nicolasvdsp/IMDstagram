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

    public function createPost( $picture, $description, $tag, $location, $users_id) {
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO posts (text, image, users_id, upload_location, tag) VALUES (:description, :picture, :users_id, :location, :tag)");
        $statement->bindValue('description', $description);
        $statement->bindValue('picture', $picture);
        $statement->bindValue('users_id', $users_id);
        $statement->bindValue('location', $location);
        $statement->bindValue('tag', $tag);
        $statement->execute();
        header('location: index.php');
    }

}