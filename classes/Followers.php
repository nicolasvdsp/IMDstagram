<?php
include_once(__DIR__ . "/Db.php");


class Friends
{
    //Alle gebruikers
    public static function Users()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    //Aantal vriendschappen weergeven
    public static function countUsers()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT count(*) FROM friendships");
        $statement->execute();
        $countUsers = $statement->fetchColumn();
        return $countUsers;
    }

    //volgend
    public static function Following($id)
    {
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT firstname, lastname FROM users INNER JOIN friendships on friendships.friend_id=users.id WHERE friendships.user_id LIKE :id');
        $search_result->bindParam(":id", $id);
        $search_result->execute();
        $value = $search_result->fetchAll();
        return $value;
    }

    //alle volgers

    public static function Followers($id)
    {
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT firstname, lastname FROM users INNER JOIN friendships on friendships.user_id=users.id WHERE friendships.friend_id LIKE :id');
        $search_result->bindParam(":id", $id);
        $search_result->execute();
        $value = $search_result->fetchAll();
        return $value;
    }

    //Verzoek krijgen

    //Verzoek sturen

    //Verzoek accepteren

    //Verzoek verwijderen

    //Volger krijgen

    //Volgend krijgen

}
