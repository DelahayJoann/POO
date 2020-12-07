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

class Form{
    private $dom;
    private $form;
    function __construct(){
        $this->dom = new DOMDocument('1.0');
        $this->form = $this->dom->createElement('form');
    }

    /**
     * Expected parameters
     * @param string $name of the input
     * @param string $text value of the input
     * @param string $type type of the input
     */
    function input(string $name, string $text, string $type){
        $input = $this->dom->createElement('input');
        $domAttribute = $this->dom->createAttribute('type');
        $domAttribute->value = $type;
        $input->appendChild($domAttribute);
        $domAttribute = $this->dom->createAttribute('name');
        $domAttribute->value = $name;
        $input->appendChild($domAttribute);
        $domInner = $this->dom->createAttribute('value');
        $domInner->value = $text;
        $input->appendChild($domInner);
        $this->form->appendChild($input);
    }

    /**
     * Expected parameters
     * @param string $name of the input
     * @param array $options an array of a string for each option
     */
    function select(string $name, array $options){
        $select = $this->dom->createElement('select');
        $domAttribute = $this->dom->createAttribute('name');
        $domAttribute->value = $name;
        $select->appendChild($domAttribute);

        foreach($options as $option){
            $input = $this->dom->createElement('option', $option);
            $domAttribute = $this->dom->createAttribute('value');
            $domAttribute->value = $option;
            $input->appendChild($domAttribute);
            $select->appendChild($input);
        }
        $this->form->appendChild($select);
    }

    /**
     * Expected parameters
     * @param string $name of the input
     * @param int $rows number of rows
     * @param int $cols number of cols
     */
    function textArea(string $name, int $rows, int $cols){
        $input = $this->dom->createElement('textarea');
        $domAttribute = $this->dom->createAttribute('name');
        $domAttribute->value = $name;
        $input->appendChild($domAttribute);
        $domRows = $this->dom->createAttribute('rows');
        $domRows->value = $rows;
        $input->appendChild($domRows);
        $domCols = $this->dom->createAttribute('cols');
        $domCols->value = $cols;
        $input->appendChild($domCols);
        $this->form->appendChild($input);
    }

    // close and return the form
    function getForm(){
        $input = $this->dom->createElement('button','Send');
        $domAttribute = $this->dom->createAttribute('type');
        $domAttribute->value = 'submit';
        $input->appendChild($domAttribute);
        $domAttribute = $this->dom->createAttribute('name');
        $domAttribute->value = 'submit';
        $input->appendChild($domAttribute);
        $this->form->appendChild($input);
        $this->dom->appendChild($this->form);

        return $this->dom->saveHTML();
    }
}
?>