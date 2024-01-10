<?php
// Classes Personnages
 class Personnages{
    public $nom;
    public $pv;
    public $att;

    public function construct($n,$p,$a){

        $this->nom=$n;
        $this->pv=$p;
        $this->att=$a;
    }
    public function getNom(){

        return $this->nom;
        }

    public function getPv(){

        return $this->pv;
        }

    
    public function getatt(){
        return $this->att;
    }
 }

//Classes enfants de Personnages
 class Heros extends Personnages{

    public function construct($n,$p,$a){

        parent::construct($n,$p,$a);
        $this->niveau=$ni;
    }
    public function getNiveau(){

        return $this->niveau;
    }
    public function setNiveau(){
        $this->niveau=$newNiveau;
    }

    public function setPV(){
        $this->pv=$npv;
    } 

    //Les Gentils
    public function getGoku(){
        $this->nom="Goku";
        $this->pv=100;
        $this->att="Kaioken Smash";// 25 dégats;
     //niveau == 10 000
    }
    public function getGohan(){
        $this->nom="Gohan";
        $this->pv=100;
        $this->att="Masenko";//15 dégats;

        //niveau == 9 000
    }
    public function getVegeta(){
        $this->nom="Vegeta";
        $this->pv=100;
        $this->att="Final Flash";//20 dégats;
        //niveau == 9 500
    }

 }
 class Mechants extends Personnages{

    protected $niveau;
    public function __construct($n,$p,$a,$ni){

        parent::construct($n,$p,$a);
        $this->niveau=$ni;
    }

    public function getNiveau(){

        return $this->niveau;
    }

    public function setNiveau(){
        $this->niveau=$newNiveau;
    }

    public function setPV(){
        $this->pv=$npv;
    } 

    //Les mechants
    public function getFreezer(){
        $this->nom="Freezer";
        $this->pv=100;
        $this->att="Rayon de la mort";//25 dégats;
        // niveau == 9 990
    }
    public function getCell(){
        $this->nom="Cell";
        $this->pv=100;
        $this->att="Absorbtion vitale";// 20 dégats;
        // niveau == 8 500
    }
    public function getBuu(){
        $this->nom="Buu";
        $this->pv=100;
        $this->att="Rayon Chocolat"; // 15 dégats;

        //niveau == 9500
    }

    public function attack(){

    }

 }

?>
