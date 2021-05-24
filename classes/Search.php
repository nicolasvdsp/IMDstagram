<?php
include_once(__DIR__ . "/Db.php");

class Search{
 


    public  function search($searchUser){
        $conn = Db::getConnection();
        $search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
        upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE firstname LIKE "%'.$q.'%" OR lastname LIKE "%'.$q.'%"');
        
        $search_result->bindValue(":search", '%'.$searchUser.'%');
        $search_result->execute();
        return $search_result;

        $results = $search_result->fetchAll();

    }


    

   /* public function searchTags($searchTags){
        $conn = Db::getConnection();
        $search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
        upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE tag LIKE "%'.$q.'%"');
        
        $search_result->bindValue(":search", '%'.$searchTags.'%');
        $search_result->execute();  
    }
*/
    /*public function searchLocation($searchLocation){
        $conn = Db::getConnection();
        $search_result = $conn->query('SELECT * FROM( select id as uid, firstname, lastname, profile_picture, null as tag, null as 
        upload_location from users union select null as uid, null as firstname, null as lastname, null as profile_picture, tag, upload_location from post ) AS t WHERE  upload_location LIKE "%'.$q.'%"');
       
       $search_result->bindValue(":search", '%'.$searchLocation.'%');
        $search_result->execute();
    }
*/

}




?>