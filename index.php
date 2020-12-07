<?php
        
class Connexion{
    private $bdd;
    function __construct(string $host, string $dbName, string $login, string $psw){
        try{
            $this->bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $login, $psw);
        }catch(Exception $e)
	    {
		    die('Erreur : '.$e->getMessage());
	    }
    }
    function countTable(string $sql):int{
        $qry = $this->bdd->prepare($sql);
        $qry->execute();
        return $qry->rowCount();
    }
}


$myConnexion = new Connexion("localhost", "becode", "Joann", "becode");

echo "Nombre d'entrée dans la table «students» de la DB «becode»: ".$myConnexion->countTable("SELECT * FROM students;");

?>