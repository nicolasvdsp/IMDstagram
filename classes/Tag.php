<?php 
Class Tag {
    private $tagsName;

    public function setTagsName($tagsName) {
        $this->tagsName = $tagsName;

        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO tags (tags_name) VALUES (:tagsName)");
        $statement->bindValue(":tagsName", $tagsName);
        $statement->execute();

        return $this;
    }
    
    public function getTagsName() {
        return $this->tagsName;
    }

    public function getAll() {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM tag");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkIfExistingTag($tagName){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM tags WHERE tags_name = :tagName");
        $statement->bindValue(":tagName", $tagName);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTagIdByTagName($tagName){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM tags WHERE tags_name = :tagName");
        $statement->bindValue(":tagName", $tagName);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
