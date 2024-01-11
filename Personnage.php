<?php
    // Classes Personnages
    class Personnages{
        public $nom;
        public $pv;
        public $att;

        public function __construct($n,$p,$a){

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

            parent::__construct($n,$p,$a);
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
    $goku = new Heros("Goku\n",100,"\nKaioken Smash\n",100000);
    $gohan = new Heros("Gohan\n",100,"\nMasenko\n",80000);
    $vegeta = new Heros("Vegeta\n",100,"\nFinal Flash\n",95000);

    function affichagedata($personnage){
        echo"Personnage selectionné:\n";
        echo "nom: ".$personnage->nom;
        echo "Points de vies: ".$personnage->pv."\n";
        echo "Attaque spéciale: ".$personnage->att."\n";
    }
    class Mechants extends Personnages{

        protected $niveau;
        public function __construct($n,$p,$a,$ni){

            parent::__construct($n,$p,$a);
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
        // public function getFreezer(){
        //     $this->nom="Freezer";
        //     $this->pv=100;
        //     $this->att="Rayon de la mort";//25 dégats;
        //     return ;

        //     // niveau == 9 990
        // }
        // public function getCell(){
        //     $this->nom="Cell";
        //     $this->pv=100;
        //     $this->att="Absorbtion vitale";// 20 dégats;
        //     // niveau == 8 500
        // }
        // public function getBuu(){
        //     $this->nom="Buu";
        //     $this->pv=100;
        //     $this->att="Rayon Chocolat"; // 15 dégats;

        //     //niveau == 9500
        // }
    }
    $freezer = new Mechants("Freezer\n",100,"\nRayon de la mort\n",100000);
    $cell = new Mechants("Cell\n",100,"\nAbsorbstion vitale\n",80000);
    $buu = new Mechants("Buu\n",100,"\nRayon Chocolat\n",95000);

    function affichagenom($perso){
        echo  "Vous allez affronter: ".$perso->nom;
    // echo "Points de vies ".$perso->pv."\n";
    // echo "Attaque spéciale ".$perso->att."\n";
    }
    // function affichagenomc($cell){
    //     echo $cell->nom;
    // }
    // function affichagenomb($buu){
    //     echo $buu->nom;
    // }

?>
