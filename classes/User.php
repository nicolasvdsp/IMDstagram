<?php
include_once(__DIR__ . "/Db.php");
class User{
    /* --- GETTERS - SETTERS - UPDATERS --- */
    public function setFirstName($firstname) {
        if(!empty($firstname)){
            $this->firstname = $firstname;
            return $this;
        } else {
            throw new Exception("Vul je voornaam in a.u.b.");
        }
    }
    public function getFirstName() {
        return $this->firstname;
    }


    public function setLastname($lastname) {
        if(!empty($lastname)){
            $this->lastname = $lastname;
            return $this;
        } else {
            throw new Exception("Vul je achternaam in a.u.b.");
        }
    }
    public function getLastname() {
        return $this->lastname;
    }


    public function setEmail($email) {
        $conn = Db::getConnection();
        $statement = $conn->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = count($statement->fetchAll());
        echo $result;

        if(!empty($email) && $result === 0){
            $this->email = $email;
            return $this;
        } else {
            throw new Exception("Vul je voornaam in a.u.b.");
        }
    }
    public function getEmail() {
        return $this->email;
    }


    public function setPassword($password) {
        $option = [
            'cost' => 12,
        ];
        $this->password = password_hash($password, PASSWORD_DEFAULT, $option);
        return $this;
    }
    public function getPassword() {
        return $this->password;
    }

    

    /* --- LOGIN AND REGISTER --- */
    public function register() {
        $firstname = $this->getFirstName();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $password = $this->getPassword();
    
        $conn = Db::getConnection();
        
        $statement = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);
        $statement->execute();
        
        $this->startSession($email);
    }

    public function yes($fn){
        if($fn === "nico"){
            return true;
        }
    }

    public function startSession($s) {
        session_start();
        $_SESSION['email'] = $s;
        header('location: index.php');
    }

    // public function checkPassword($password, $passwordRepeat) {
    //     $option = [
    //         'cost' => 12,
    //     ];
    //     $passwordRepeatHashed = password_hash($passwordRepeat, PASSWORD_DEFAULT, $option);
    //     if($password === $passwordRepeatHashed){
    //         return true;
    //     }
    // }



}