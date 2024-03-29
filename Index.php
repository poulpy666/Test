<?php
//Creation de la classe personnage
class Personnage {
    public $nom;
    public $niveau_puissance;
    public $points_vie;

    public function __construct($nom, $niveau_puissance, $points_vie) {
        $this->nom = $nom;
        $this->niveau_puissance = $niveau_puissance;
        $this->points_vie = $points_vie;
    }
// Nous avons rajoutés pv=0 pour éviter d'avoir des valeurs négatives
    public function prendreDegats($degats) {
        $this->points_vie -= $degats;
        if ($this->points_vie <= 0) {
            $this->points_vie = 0; 
        }
    }
}
//Creation de la classe Heros enfant de personnage
class Hero extends Personnage {
    public $super_pouvoir;

    public function __construct($nom, $niveau_puissance, $points_vie, $super_pouvoir) {
        parent::__construct($nom, $niveau_puissance, $points_vie);
        $this->super_pouvoir = $super_pouvoir;
    }
// definit une action choisie par l'utilisateur.
//l'utilisateur est obligé de choisir une des trois actions.
    public function choisirAttaque() {
        do {
            echo "Choisissez une attaque pour " .$this->nom ." :\n";
            echo "1: Attaque spéciale \n";
            echo "2: Attaque au corps à corps\n";
            echo "3: Se défendre\n";
    
            $choix = readline("Entrez le numéro de l'attaque que vous souhaitez utiliser : ");
    
            if ($choix < 1 || $choix > 3) {
                echo "Choix invalide. Veuillez entrer un numéro entre 1 et 3.\n";
            }
    
        } while ($choix < 1 || $choix > 3);
    
        return $choix;
    }
    // Les fonction attaquer se défendre definissent les impacts des actions de l'utilisateur.
    public function attaquer($cible, $attaqueChoisie) {
        if ($attaqueChoisie == 1) {
            $degats = (($this->super_pouvoir + $this->niveau_puissance)/ 20);
            $cible->prendreDegats($degats);
            echo $this->nom ." attaque ".$cible->nom." avec son attaque spéciale et inflige ".$degats. " dégâts!\n";
        } elseif ($attaqueChoisie == 2) {
            $cible->prendreDegats($this->super_pouvoir/0.5);
            echo $this->nom." utilise son attaque au corps à corps contre ".$cible->nom ." et inflige " .$this->super_pouvoir." dégâts!\n";
        } elseif ($attaqueChoisie == 3) {
            $this->seDefendre($cible);
        }
    }
    public function seDefendre($cible) {    
        // Le méchant attaque par défaut après que le héros s'est défendu
        $this->prendreDegats($cible->pouvoir_special);
        echo $this->nom . " encaisse l'attaque normale de " . $cible->nom . " et subit " . $cible->pouvoir_special . " dégâts!\n";
    }
    // augmente le niveau de puissance du héros après la victoire
    public function gagnerCombat() {
            $this->niveau_puissance *= 1.2; // Augmenter la puissance de 20%
    }
}

class Mechant extends Personnage {
    public $pouvoir_special;

    public function __construct($nom, $niveau_puissance, $points_vie, $pouvoir_special) {
        parent::__construct($nom, $niveau_puissance, $points_vie);
        $this->pouvoir_special = $pouvoir_special;
    }
//aléatoire des actions ennemies
    public function choisirAttaque() {
        return rand(1, 3);
    }

    public function attaquer($cible, $attaqueChoisie = null) {
        if ($attaqueChoisie === null) {
            $attaqueChoisie = $this->choisirAttaque();
        }
        if ($attaqueChoisie == 1) {
            $degats = (($this->pouvoir_special + $this->niveau_puissance )/ 20);
            $cible->prendreDegats($degats);
            echo $this->nom." attaque " .$cible->nom." avec son attaque spéciale et inflige ".$degats." dégâts!\n";
        } elseif ($attaqueChoisie == 2) {
            $cible->prendreDegats($this->pouvoir_special);
            echo $this->nom ." utilise son attaque au corps à corps contre ".$cible->nom." et inflige ".$this->pouvoir_special." dégâts!\n";
        } elseif ($attaqueChoisie == 3) {
            $degats = $this->pouvoir_special / 2;
            $cible->prendreDegats($degats);
            echo $this->nom ." se défend et réduit les dégâts reçus de ".$degats."!\n";
        }
    }
}