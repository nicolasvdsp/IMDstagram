<?php
include_once(__DIR__ . "/Db.php");


class Followers
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


    //Verzoek krijgen

    //Verzoek sturen

    //Verzoek accepteren

    //Verzoek verwijderen

    //Volger krijgen

    //Volgend krijgen

}