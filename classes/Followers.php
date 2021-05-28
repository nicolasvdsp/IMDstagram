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
        $search_result = $conn->prepare('SELECT firstname, lastname FROM users INNER JOIN friendships on friendships.friend_id=users.id WHERE friendships.user_id LIKE :id AND status = 1');
        $search_result->bindParam(":id", $id);
        $search_result->execute();
        $value = $search_result->fetchAll();
        return $value;
    }

    //alle volgers

    public static function Followers($id)
    {
        $conn = Db::getConnection();
        $search_result = $conn->prepare('SELECT firstname, lastname FROM users INNER JOIN friendships on friendships.user_id=users.id WHERE friendships.friend_id LIKE :id AND status = 1');
        $search_result->bindParam(":id", $id);
        $search_result->execute();
        $value = $search_result->fetchAll();
        return $value;
    }

    //Verzoek krijgen
    public static function GetRequest($id)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT firstname, lastname, users.id FROM users INNER JOIN friendships on friendships.user_id=users.id WHERE friend_id = :user AND status = 0");
        $statement->bindValue(':user', $id);
        $statement->execute();
        $value = $statement->fetchAll();
        return $value;
    }

    //Verzoek sturen
    public static function SendRequest($id)
    {
        if (isset($_POST['id'])) {
            $request = $_POST["id"];
        }
        if (!empty($request)) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM friendships WHERE user_id = :user AND friend_id = :friend");
            $statement->bindValue(':user', $id);
            $statement->bindValue(':friend', $request);
            $statement->execute();
            $value = $statement->fetchAll();
            if (empty($value)) {
                $statement = $conn->prepare("INSERT INTO friendships (user_id, friend_id, status) VALUES (:user, :friend, 0)");
                $statement->bindValue(':user', $id);
                $statement->bindValue(':friend', $request);
                $statement->execute();
            }
        }
    }

    //Verzoek accepteren STATUS = 1
    public static function AcceptRequest($id)
    {
        if (isset($_POST['accept'])) {
            $request = $_POST["accept"];
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE friendships SET status = 1 WHERE friend_id = :id AND user_id = :friend");
            $statement->bindValue(":friend", $request);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }
    }

    //Verzoek verwijderen 
    public static function DeleteRequest($id)
    {
        if (isset($_POST['delete'])) {
            $request = $_POST["delete"];
            $conn = Db::getConnection();
            $statement = $conn->prepare("DELETE FROM friendships WHERE friend_id = :id AND user_id = :friend");
            $statement->bindValue(":friend", $request);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }
    }

    //Volger krijgen

    //Volgend krijgen

}
