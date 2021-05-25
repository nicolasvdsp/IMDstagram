<?php
include_once(__DIR__ . "/Db.php");

//$search = $_GET['q'];

class Search{
    //GEBRUIKER OPZOEKEN
  public function searchUser($searchUser){
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
        upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE firstname LIKE :search OR lastname LIKE :search ');
        $searchItem = "%".$searchUser."%";
        $search_result->bindParam(":search", $searchItem);
        $search_result->execute();
        $value = $search_result->fetchAll(); 
        return $value; 
    }

    //TAG OPZOEKEN
    public function searchTag($searchTag){
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
        upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE tag LIKE :search');
        $searchItem = "%".$searchTag."%";
        $search_result->bindParam(":search", $searchItem);
        $search_result->execute();
        $value = $search_result->fetchAll(); 
        return $value; 
    }


    //LOCATIE OPZOEKEN
    public function searchLocation($searchLocation){
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
        upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE location LIKE :search');
        $searchItem = "%".$searchLocation."%";
        $search_result->bindParam(":search", $searchItem);
        $search_result->execute();
        $value = $search_result->fetchAll(); 
        return $value; 
    }

}


?>