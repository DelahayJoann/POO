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
    static function connect(string $host, string $dbName, string $login, string $psw){
        return new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $login, $psw);
    }
    function countTable(string $sql):int{
        $qry = $this->bdd->prepare($sql);
        $qry->execute();
        return $qry->rowCount();
    }
    function qry(string $sql){
        $result = query($sql);
        return $result;
    }
}

class Post{
    private $id_post = null;
    private $title_post;
    private $content_post;
    function __construct($id,string $title,string $content){
        $this->id_post = $id;
        $this->title_post = $title;
        $this->content_post = $content;
    }
    // return false if only exist localy, else his id in database's table
    function getStatus():mixed{
        return ($id_post == null)? false : $this->id_post;
    }
    function addPost():int{ //return $id_post
        $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
        $qry = $conn->prepare("INSERT INTO blog VALUES (:id,:title,:content);");
        $qry->execute(array(':id'=> NULL, ':title'=> $this->title_post, ':content'=> $this->content_post));
        $this->id_post = $conn->lastInsertId();
        return $conn->lastInsertId();
    }
    function removePost():int{ //return 0 if failed or 1+ if succeed
        $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
        $qry = $conn->prepare("DELETE FROM blog WHERE id_post = ?");
        $qry->execute($this->id_post);
        return $conn;
    }
    static function findAllPost():array{ //return array of Post objects
        $returnArray= [];
        $conn = Connexion::connect("localhost", "becode", "Joann", "becode");
        $qry = $conn->prepare("SELECT * FROM blog");
        $qry->execute();
        while($ft = $qry->fetch()){
            $returnArray[] = new Post($ft['id_post'],$ft['title_post'],$ft['content_post']);
        }
        return $returnArray;
    }
    function getId(){return $this->id_post;}
    function getTitle(){return $this->title_post;}
    function setTitle(string $string){$this->title_post = $string;}
    function getContent(){return $this->content_post;}
    function setContent(string $string){$this->content_post = $string;}
}
?>