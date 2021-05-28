<?php
include_once(__DIR__ . "/Db.php");

//$search = $_GET['q'];

class Search{
    //GEBRUIKER OPZOEKEN
  public function searchUser($searchUser){
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as upload_location 
        from users union select null as uid, null as firstname, null as lastname, null as profile_picture, upload_location from posts) 
        AS t WHERE firstname LIKE :search OR lastname LIKE :search ');
        
        $searchItem = "%".$searchUser."%";
        $search_result->bindParam(":search", $searchItem);
        $search_result->execute();
        $value = $search_result->fetchAll(); 
        return $value; 
    }

    //TAG OPZOEKEN
    public function searchTag($searchTag){
        $conn = Db::getConnection();
       //$search_result = $conn->prepare('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag_id, null as 
      // upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from posts ) AS t WHERE tag_id LIKE :search');

    $search_result = $conn->prepare('SELECT * FROM( select id as uid, tags_id, upload_location, null as tags_name 
    from posts union select null as uid, null as tags_id, null as upload_location, tags_name from tags) 
    AS t WHERE tags_name LIKE :search');


        $searchItem = "%".$searchTag."%";
        $search_result->bindParam(":search", $searchItem);
        $search_result->execute();
        $value = $search_result->fetchAll(); 
        return $value; 
    }


    //LOCATIE OPZOEKEN
    public function searchLocation($searchLocation){
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as upload_location 
        from users union select null as uid, null as firstname, null as lastname, null as profile_picture, upload_location from posts) 
        AS t WHERE upload_location LIKE :search');

        $searchItem = "%".$searchLocation."%";
        $search_result->bindParam(":search", $searchItem);
        $search_result->execute();
        $value = $search_result->fetchAll(); 

        return $value; 
    }



}


?>