<?php
include_once(__DIR__ . "/Db.php");
class User{
    /* --- GETTERS - SETTERS - UPDATERS --- */
    public function setFirstName($firstname) {
        $this->firstname = $firstname;
        return $this;
    }
    public function getFirstName() {
        return $this->firstname;
    }


    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }
    public function getLastname() {
        return $this->lastname;
    }


    public function setEmail($email) {
        $this->email = $email;
        return $this;
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