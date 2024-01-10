<?php
// CLasses Personnage
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
    public function construct($n,$p,$ni){

        parent::construct($n);
        $this->niveau=$ni;
    }
    public function getNiveau(){

        return $this->niveau;
    }

 }
 class Mechants extends Personnages{

    parent::construct($n,$ni,$pn,$a);
    protected $niveau;
    public function __construct($n,$p,$a,$ni){

        parent::construct($n,$pn,$a);
        $this->niveau=$ni;
    }
    public function getNiveau(){

        return $this->niveau;
    }

 }
?>
