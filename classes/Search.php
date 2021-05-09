<?php
include_once(__DIR__ . "/Db.php");

class Search{
    /*public static function search($search)
    {

    }*/

    public static function searchUser($searchUser){
        $conn = Db::getConnection();
        $searchQuerry = $conn->prepare("SELECT * FROM `users` WHERE firstname LIKE :search OR lastname LIKE :search"); //or die($mysqli->error);
        $searchQuerry->bindValue(":search", '%'.$searchUser.'%');
        $searchQuerry->execute();
        $searchQuerry->execute();

    }

}



 /*   public static function getPostData($search){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM post WHERE id = :id");
        $statement->bindValue(':id', $search);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }*/


?>