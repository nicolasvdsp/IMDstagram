    <?php
    include_once(__DIR__ . "/Db.php");
    class User{
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $userId;
        private $biography;
        private $profilePicture;


        /* --- GETTERS - SETTERS - UPDATERS --- */
        public function setFirstName($firstname) {
            if(!empty($firstname)){
                $this->firstname = $firstname;
                return $this;
            } else {
                throw new Exception("vul je voornaam in");
            }
        }
        public function getFirstName() {
            return $this->firstname;
        }
        public function updateFirstName($firstname, $id) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE users SET firstname = :firstname WHERE id = :id");
            $statement->bindValue(":firstname", $firstname);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }


    public function setLastname($lastname) {
        if(!empty($lastname)){
            $this->lastname = $lastname;
            return $this;
        } else {
            throw new Exception("vul je achternaam in");
        }
    }
    public function getLastname() {
        return $this->lastname;
    }


    public function setEmail($email) {
        if(!empty($email)){
            $this->email = $email;
            return $this;
        } else {
            throw new Exception("vul je email in");
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

    public function updatePassword($password, $id) {
        $option = [
            'cost' => 12,
        ];
        $newPassword = password_hash($password, PASSWORD_DEFAULT, $option);
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
        $statement->bindValue(":password", $newPassword);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }
    
    public function getUserId() {
        return $this->userId;
    }

    public function setBiography($biography) {
        $this->biography = $biography;
        return $this;
    }

    public function getBiography() {
        return $this->biography;
    }

    public function updateDetails(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, bio = :biography WHERE id = :userId");
        
        $firstname = $this->getFirstName();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $biography = $this->getBiography();
        $userId = $this->getUserId();
        
        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":biography", $biography);
        $statement->bindValue(":userId", $userId);
        

        $statement->execute();
    }


    public function setProfilePicture($profilePicture) {
        $this->profilePicture = $profilePicture;
        return $this;
    }
    public function getProfilePicture() {
        return $this->profilePicture;
    }

    public function uploadProfilePicture($profilePicture, $id) {
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET profile_picture = :profilePicture WHERE id = :id");
        $statement->bindValue(":profilePicture", $profilePicture);
        $statement->bindValue(":id", $id);
        $statement->execute();
        header('location: usersettings.php');
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
    }

    public function canLogin($email, $password) {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        if(!$result) {
            return false;
        }

        $pw_hash = $result['password'];
        if(password_verify($password, $pw_hash)) {
            return true;
            //echo $this->getEmail();
        } else {
            return false;
        }


    }

    public static function getIdByEmail($email){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        return $result['id'];
    }

    public static function getUserDataFromId($id){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    public function startSession() {
        $sessionId = $this->getUserId();

        session_start();
        $_SESSION['id'] = $sessionId;
        header('location: index.php');
    }
}