<?php

class Voiture{
    private $numImma,$dateMiseCirc,$kilometrage,$modele,$marque,$couleur,$poids,$status,$type,$pays,$usure,$annee,$image;

    /**
     * Expected parameters
     * @param string $numImma Numéro d'immatriculation du véhicule
     * @param DateTime $dateMiseCirc Date de mise en circulation du véhicule
     * @param float $kilometrage Kilomètrage du véhicule
     * @param string $modele Modèle du véhicule
     * @param string $marque Marque du véhicule
     * @param string $couleur Couleur du véhicule
     * @param float $poids Poids en Tonne du véhicule
     */
    function __construct(string $numImma,DateTime $dateMiseCirc,float $kilometrage,string $modele,string $marque,string $couleur,float $poids){
        $this->numImma = $numImma;
        $this->dateMiseCirc = $dateMiseCirc;
        $this->kilometrage = $kilometrage;
        $this->modele = $modele;
        $this->marque = $marque;
        $this->couleur = $couleur;
        $this->poids = $poids;

        $this->status = ($this->marque == "Audi")? "reserved" : "free";
        $this->type = ($this->poids > 3500)? "utilitaire" : "commerciale";
        switch(substr($this->numImma,0,2)){
            case "BE": $this->pays = "Belgique";break;
            case "FR": $this->pays = "France";break;
            case "DE": $this->pays = "Allemagne";break;
        }
        $this->checkUsure();
        $this->annee = (new \DateTime())->diff($this->dateMiseCirc);
    }
    private function checkUsure(){
        switch(true){
            case $this->kilometrage < 100000: $this->usure = "low";
            case $this->kilometrage > 100000: $this->usure = "middle";
            case $this->kilometrage > 200000: $this->usure = "high";
        }
    }

    // Return a tr (table)
    function display(){
        $dom = new DOMDocument('1.0');
        $tr = $dom->createElement('tr');

        $domAttr0 = $dom->createAttribute('style');
        $domAttr0->value = "border: 1px solid black;text-align: center;";
        $domAttr1 = $dom->createAttribute('style');
        $domAttr1->value = "border: 1px solid black;text-align: center;";
        $domAttr2 = $dom->createAttribute('style');
        $domAttr2->value = "border: 1px solid black;text-align: center;";
        $domAttr3 = $dom->createAttribute('style');
        $domAttr3->value = "border: 1px solid black;text-align: center;";
        $domAttr4 = $dom->createAttribute('style');
        $domAttr4->value = "border: 1px solid black;text-align: center;";
        $domAttr5 = $dom->createAttribute('style');
        $domAttr5->value = "border: 1px solid black;text-align: center;";
        $domAttr6 = $dom->createAttribute('style');
        $domAttr6->value = "border: 1px solid black;text-align: center;";
        $domAttr7 = $dom->createAttribute('style');
        $domAttr7->value = "border: 1px solid black;text-align: center;";


        $td0 = $dom->createElement('td');
        $img = $dom->createElement('img');
        $domAttribute = $dom->createAttribute('style');
        $domAttribute->value = "max-width: 200px;";
        $img->appendChild($domAttribute);
        $domAttribute = $dom->createAttribute('src');
        $domAttribute->value = $this->image;
        $img->appendChild($domAttribute);
        $domAttribute = $dom->createAttribute('alt');
        $domAttribute->value = $this->marque.' '.$this->modele;
        $img->appendChild($domAttribute);
        $td0->appendChild($img);

        $td0->appendChild($domAttr0);

        $td1 = $dom->createElement('td',$this->numImma);
        $td1->appendChild($domAttr1);
        $td2 = $dom->createElement('td',$this->dateMiseCirc->format('y/m/d'));
        $td2->appendChild($domAttr2);
        $td3 = $dom->createElement('td',$this->kilometrage);
        $td3->appendChild($domAttr3);
        $td4 = $dom->createElement('td',$this->modele);
        $td4->appendChild($domAttr4);
        $td5 = $dom->createElement('td',$this->marque);
        $td5->appendChild($domAttr5);
        $td6 = $dom->createElement('td',$this->couleur);
        $td6->appendChild($domAttr6);
        $td7 = $dom->createElement('td',$this->poids);
        $td7->appendChild($domAttr7);

        
        $tr->appendChild($td0);
        $tr->appendChild($td1);
        $tr->appendChild($td2);
        $tr->appendChild($td3);
        $tr->appendChild($td4);
        $tr->appendChild($td5);
        $tr->appendChild($td6);
        $tr->appendChild($td7);

        $dom->appendChild($tr);

        return $dom->saveHTML();
    }

    function roule(){
        $this->kilometrage += 100000;
        $this->usure = "high";
    }

    function setKilometrage(float $kilometrage){
        $this->kilometrage = $kilometrage;
        checkUsure();
    }
    function getKilometrage(){
        return $this->kilometrage;
    }
    function setCouleur(string $couleur){
        $this->couleur = $couleur;
    }
    function getCouleur(){
        return $this->couleur;
    }
    function setPoids(float $poids){
        $this->couleur = $couleur;
    }
    function getPoids(){
        return $this->poids;
    }

    function getNumImma(){
        return $this->numImma;
    }
    function getDateMiseCirc(){
        return $this->dateMiseCirc;
    }
    function getModele(){
        return $this->modele;
    }
    function getMarque(){
        return $this->marque;
    }

    function getUsure(){
        return $this->usure;
    }

    function setStatus(string $string){
        $this->status = $string;
    }
    function getStatus(){
        return $this->status;
    }

    function getType(){
        return $this->type;
    }
    function getPays(){
        return $this->pays;
    }
    function getAnnee(){
        return $this->annee;
    }

    function setImage(string $path){
        $this->image = $path;
    }
    function getImage(){
        return $this->image;
    }
}

?>