<?php
require 'class.php';

class User{
    private $id,$username,$email,$password,$connected = 0;

    function __construct(string $username, string $password){
        if(Validator::validateString($username) && Validator::validateString($password)){
            $this->username = $username;
            $this->password = sha1($password);
        }else{
            die();
        }
    }

    function status(){
        return $this->connected;
    }

    // Return id in database
    static function addUser(string $username, string $email, string $password):int{
        if(Validator::validateString($username) && Validator::validateString($password) && Validator::validateEmail($email)){
            $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
            $qry = $conn->prepare("INSERT INTO ex_database VALUES (:id,:username,:email,:password);");
            $qry->execute(array(':id'=> NULL, ':username'=> $username, ':email'=> $email, ':password' => sha1($password)));
            return $conn->lastInsertId();
        }
        else{
            return 'ERROR';
        }
    }
    function updateUsername(string $name){
        if(Validator::validateString($name)){
            $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
            $qry = $conn->prepare("UPDATE ex_database SET user_name = :username;");
            $qry->execute(array(':username'=> $name));
            $this->username = $name;
            return 'DONE: '.$name;
        }
        else{
            return 'ERROR';
        }
    }
    function updateEmail(string $email){
        if(Validator::validateEmail($email)){
            $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
            $qry = $conn->prepare("UPDATE ex_database SET user_email = :email;");
            $qry->execute(array(':email'=> $email));
            $this->email = $email;
            return 'DONE: '.$email;
        }
        else{
            return 'ERROR';
        }
    }
    function removeMe(){
        $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
        $qry = $conn->prepare("DELETE FROM ex_database WHERE user_id = :id;");
        $qry->execute(array(':id'=> $this->id));
        return 'DONE';
    }

    function connect(){
        $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
        $check = $conn->query("SELECT * FROM ex_database WHERE user_name = '".$this->username."' AND user_password = '".$this->password."';");
        $count = 0;

        if($check != false){
            while($donnees = $check->fetch()){
                $count = $count + 1;
                $this->id = $donnees['user_id'];
                $this->email = $donnees['user_email'];
                $this->username = $donnees['user_name'];
                $this->password = $donnees['user_password'];
                $this->connected = 1;
            }
        }
    
        if ($count) {
            session_start ();
            
            $_SESSION['login'] = $this->username;
            $_SESSION['pwd'] = sha1($this->password);
            
            $check->closeCursor();
        }
        else{
            $check->closeCursor();
        }
    }

    function disconnect(){
        session_unset ();
        session_destroy ();
        $this->connected = 0;
    }
}

?>