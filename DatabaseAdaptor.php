<?php

//
class DatabaseAdaptor
{

    private $DB;

    // The construct will connect to the needed database triabl
    public function __construct()
    {
        $dataBase = 'mysql:dbname=tribal2;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = ''; // Empty string with XAMPP install
        try {
            $this->DB = new PDO($dataBase, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing Connection');
            exit();
        }
    }

    // This function exists only for testing purposes. Do not call it any other time.
    public function startFromScratch()
    {
        $stmt = $this->DB->prepare("DROP DATABASE IF EXISTS tribal2;");
        $stmt->execute();

        // This will fail unless you created database quotes inside MariaDB.
        $stmt = $this->DB->prepare("create database tribal2;");
        $stmt->execute();

        $stmt = $this->DB->prepare("use tribal2;");
        $stmt->execute();

        $update = " CREATE TABLE tribes ( " . " id int(20) NOT NULL AUTO_INCREMENT, name varchar(2000), description varchar(2000), rating int(11), PRIMARY KEY (id));";
        $stmt = $this->DB->prepare($update);
        $stmt->execute();

        $update = "CREATE TABLE users ( " . "id int(20) NOT NULL AUTO_INCREMENT, name varchar(64),
            password varchar(255), tribe varchar(2000), PRIMARY KEY (id) );";
        $stmt = $this->DB->prepare($update);
        $stmt->execute();

        $update = "CREATE TABLE tribeStream ( " . "id int(20) NOT NULL AUTO_INCREMENT, tribe varchar(64),
            user varchar(255), point varchar(2000), PRIMARY KEY (id) );";
        $stmt = $this->DB->prepare($update);
        $stmt->execute();
    }

    // ^^^^^^^ Keep all code above for testing ^^^^^^^^^

    // ///////////////////////////////////////////////////////////
    // Complete these five straightfoward functions and run as a CLI application
    public function getAllTribes()
    {
        $val = $this->DB->prepare("SELECT * FROM tribes ORDER BY rating DESC;");
        $val->execute();
        return $val->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        // Just sent the array
        $val = $this->DB->prepare("SELECT * FROM users;");
        $val->execute();
        return $val->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTribeStreamWhen($name){
        $val = $this->DB->prepare("SELECT * FROM tribeStream WHERE tribe='".$name."';");
        $val->execute();
        return $val->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTribeWhen($name){
        $val = $this->DB->prepare("SELECT * FROM tribes WHERE name='" . $name . "';");
        $val->execute();
        return $val->fetchAll(PDO::FETCH_ASSOC);
    }

    public function raiseRating($ID)
    {
        $val = $this->DB->prepare("UPDATE quotations SET rating = rating+1 WHERE id = :ID;");
        $val->bindParam(':ID', $ID);
        $val->execute();
    }

    public function beTribe($name,$user){
        $val = $this->DB->prepare("UPDATE users SET tribe ='" . $name . "' WHERE name = '" . $user . "';");
        $val->execute();
    }

    public function deleteTribeStream($user,$tribe){
        $val = $this->DB->prepare("DELETE FROM tribeStream WHERE user =:user1 AND tribe = :tribe1;");
        $val->bindParam(':user1', $user);
        $val->bindParam(':tribe1', $tribe);
        $val->execute();
    }

    public function lowerRating($ID)
    {
        $val = $this->DB->prepare("UPDATE tribes SET rating = rating-1 WHERE id = :idDb;");
        $val->bindParam(':idDb', $ID);
        $val->execute();
    }

    public function addStream($tribe,$point, $user)
    {
        $point = htmlspecialchars($point);
        $tribe = htmlspecialchars($tribe);
        $user = htmlspecialchars($user);
        $val = $this->DB->prepare("INSERT INTO tribeStream (tribe,user,point) VALUES(:tribe,:user,:point);");
        $val->bindParam(':point', $point);
        $val->bindParam(':tribe', $tribe);
        $val->bindParam(':user', $user);
        $val->execute();
    }

    public function addUser($accountname, $psw)
    {
        $accountname = htmlspecialchars($accountname);
        $psw = htmlspecialchars($psw);
        $pass = password_hash($psw, PASSWORD_DEFAULT);
        // $pass = htmlspecialchars($pass);
        $_SESSION['pass'] = $pass;
        
        $val = $this->DB->prepare("INSERT INTO users (name,password) VALUES(:accountname,:psw);");
        $val->bindParam(':psw', $pass);
        $val->bindParam(':accountname', $accountname);
        $val->execute();
    }

    public function addTribe($tribeName, $missionState)
    {
        $tribeName = htmlspecialchars($tribeName);
        $missionState = htmlspecialchars($missionState);
        
        // $pass = htmlspecialchars($pass);
        $_SESSION['curTribe'] = $tribeName;
        $val = $this->DB->prepare("INSERT INTO tribes (name,description,rating) VALUES(:tribeName,:missionState,0.0);");
        $val->bindParam(':tribeName', $tribeName);
        $val->bindParam(':missionState', $missionState);
        $val->execute();
    }

    // NEW method to delete tribes from the database
    public function deleteTribe($ID)
    {
        $val = $this->DB->prepare("DELETE FROM tribes WHERE name='".$ID."';");
       // $val->bindParam(':ID', $ID);
        $val->execute();
    }

    public function verifyCredentials($accountName, $psw)
    {

        // This function is more difficult than the four above
        $accountName = htmlspecialchars($accountName);
        $psw = htmlspecialchars($psw);
        $passWord = $this->DB->prepare("SELECT password FROM users WHERE name= :accountName;");
        $passWord->bindParam(':accountName', $accountName);

        $passWord->execute();
        $arr = $passWord->fetchAll(PDO::FETCH_ASSOC);

        if (! empty($arr) == 1) {
            if (password_verify($psw, $arr[0]['password'])) {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    public function verifyUserName($accountName)
    {
        $userName = $this->DB->prepare("SELECT name FROM users WHERE name= :accountName;");
        $userName->bindParam(':accountName', $accountName);
        $userName->execute();
        $arr = $userName->fetchAll(PDO::FETCH_ASSOC);
        if (! empty($arr) == 1) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    

}

?>