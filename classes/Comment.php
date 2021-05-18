<?php 
    class Comment {
        public function setText($text) {
            if(!empty($text)) {
                $this->text = $text;
                return $this;
            } else {
                $errorText = "Empty comment";
            }
        }
        
        public function getText() {
            return $this->text;
        }


        public function setPostId($postId) {
            if(!empty($postId)) {
                $this->postId = $postId;
                return $this;
            } else {
                $errorPostId = "postId can't be empty";
            }
        }
        
        public function getPostId() {
            return $this->postId;
        }

        public function setUserId($userId) {
            if(!empty($userId)) {
                $this->userId = $userId;
                return $this;
            } else {
                $error = "userId can't be empty";
            }
        }
        
        public function getUserId() {
            return $this->userId;
        }

        public function saveComment() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO comments (text, post_id, user_id) VALUES (:text, :postId, :userId)");
            
            $text = $this->getText();
            $postId = $this->getPostId();
            $userId = $this->getUserId();

            $statement->bindValue(":text", $text);
            $statement->bindValue(":postId", $postId);
            $statement->bindValue(":userId", $userId);

            $result = $statement->execute();
            return $result;
        }

        public static function getAll($postId) {
            $conn = Db::getConnection();
            $statement = $conn->prepare('SELECT * FROM users INNER JOIN comments ON users.id = comments.user_id WHERE post_id = :postId');
            $statement->bindValue(":postId", $postId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public static function getSome($postId) {
            $conn = Db::getConnection();
            $statement = $conn->prepare('SELECT * FROM users INNER JOIN comments ON users.id = comments.user_id WHERE post_id = :postId LIMIT 1');
            $statement->bindValue(":postId", $postId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }