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
    protected $niveau;
    public function __construct($n,$p,$a,$ni){

        parent::construct($n,$p,$a);
        $this->niveau=$ni;
    }
    public function getNiveau(){

        return $this->niveau;
    }
    public function setNiveau($newNiveau){
        $this->niveau=$newNiveau;
    }

    public function setPV($npv){
       $this->pv=$npv;
    } 
    //Les Gentils   
 }
 $goku = new Heros("Goku",100,"Kaioken Smash",100000);
 $gohan = new Heros("Gohan",100,"Masenko",80000);
 $vegeta = new Heros("Vegeta",100,"Final Flash",95000);

 function affichagedata($personnage){
    echo $personnage->nom;
    echo $personnage->pv;
    echo $personnage->att;
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
       // $this->niveau=$newNiveau;
    }

    public function setPV(){
      //  $this->pv=$npv;
    } 
    
    //Les mechants
    public function getFreezer(){
        $this->nom="Freezer";
        $this->pv=100;
        $this->att="Rayon de la mort";//25 dégats;
        return ;

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
