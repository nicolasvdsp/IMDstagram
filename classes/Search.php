<?php
include_once(__DIR__ . "/Db.php");

class Search{
    public static function search($search){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();

        $id = $statement->fecth(PDO::FETCH_COLUMN);


        $statement = $conn->prepare("SELECT users.id, firstname, lastname, email, profile_picture FROM users
        INNER JOIN post on users.users_id=post.users_id WHERE 
        ");
 
    }
}

?>