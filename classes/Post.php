<?php 

class Post {

    public function setText($text) {
        $this->text = $text;
        return $this;
    }
    
    public function getText() {
        return $this->text;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }
    
    public function getImage() {
        return $this->image;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }
    
    public function getUserId() {
        return $this->userId;
    }

    public function setUploadLocation($uploadLocation) {
        $this->uploadLocation = $uploadLocation;
        return $this;
    }
    
    public function getUploadLocation() {
        return $this->uploadLocation;
    }

    public function setTagsId($tagsId) {
        $this->tagsId = $tagsId;
        return $this;
    }
    
    public function getTagsId() {
        return $this->tagsId;
    }

    public function setFilter($filter) {
        $this->filter = $filter;
        return $this;
    }
    
    public function getFilter() {
        return $this->filter;
    }

    public function getAllPosts(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM filters INNER JOIN posts ON filters.id = posts.filter_id ORDER BY created_time DESC");
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

    public function getPost($postId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM posts WHERE id = :id");
        $statement->bindValue(':id', $postId);
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

    public function createPost() {
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO posts (text, image, users_id, upload_location, tags_id, filter_id) VALUES (:text, :image, :users_id, :location, :tags_id, (SELECT id FROM filters WHERE filter = :filter))");
        
        $text = $this->getText();
        $image = $this->getImage();
        $users_id = $this->getUserId();
        $location = $this->getUploadLocation();
        $tags_id = $this->getTagsId();
        $filter = $this->getFilter();

        
        $statement->bindValue(":text", $text);
        $statement->bindValue(":image", $image);
        $statement->bindValue(":users_id", $users_id);
        $statement->bindValue(":location", $location);
        $statement->bindValue(":tags_id", $tags_id);
        $statement->bindValue(":filter", $filter);
        
        $result = $statement->execute();
        var_dump($result);
    }

    public static function loadFilters() {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM filters");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}