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

    public function getAllPostsOfUser($usersId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM posts WHERE users_id = :id");
        $statement->bindValue(':id', $usersId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTagsByPostId($postId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM tags INNER JOIN posts ON tags.id = posts.tags_id WHERE posts.id = :postId");
        $statement->bindValue(':postId', $postId);
        $statement->execute();
        $username = $statement->fetch(PDO::FETCH_ASSOC);
        return $username;
    }

    public function getPostsByTagId($tagsId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM posts INNER JOIN users ON posts.users_id = users.id INNER JOIN tags ON posts.tags_id = tags.id WHERE tags.id = :tagsId");
        $statement->bindValue(':tagsId', $tagsId);
        $statement->execute();
        $username = $statement->fetchAll(PDO::FETCH_ASSOC);
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