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
//Fonction Degats
    public function prendreDegats($degats) {
        $this->points_vie -= $degats;
        if ($this->points_vie < 0) {
            $this->mourir();
        }
    }
//Fonction Mourrir
    public function mourir() {
        echo $this->nom . " est vaincu!\n";
    }
}
//Classe enfant Hero
class Hero extends Personnage {
    public $super_pouvoir;
    private $attaque_speciale;

    public function __construct($nom, $niveau_puissance, $points_vie, $super_pouvoir) {
        parent::__construct($nom, $niveau_puissance, $points_vie);
        $this->super_pouvoir = $super_pouvoir;
    }
//fonction choix attaque 
    public function choisirAttaque() {
        echo "Choisissez une attaque pour " . $this->nom . " :\n";
        echo "1: Attaque normale\n";
        echo "2: Attaque spéciale\n";
        echo "3: Se défendre\n";

        $choix = readline("Entrez le numéro de l'attaque que vous souhaitez utiliser : ");
        return $choix;
    }
    public function attaquer($cible) {
        if ($this->attaque_speciale) {
            // Utiliser l'attaque spéciale
            $cible->prendreDegats($this->niveau_puissance + $this->super_pouvoir * 2);
        } else {
            // Utiliser l'attaque normale
            $cible->prendreDegats($this->niveau_puissance + $this->super_pouvoir);
        }
    }
    public function debloquerAttaqueSpeciale() {
        $this->attaque_speciale_debloquee = true;
        echo $this->nom . " a débloqué une nouvelle attaque spéciale!\n";
    }
}

class Mechant extends Personnage {
    public $pouvoir_special;

    public function __construct($nom, $niveau_puissance, $points_vie, $pouvoir_special) {
        parent::__construct($nom, $niveau_puissance, $points_vie);
        $this->pouvoir_special = $pouvoir_special;
    }

    public function choisirAttaque() {
        // Générer une action aléatoire (1 pour attaquer, 2 pour se défendre)
        return rand(1, 2);
    }

    // Redéfinir la méthode attaquer pour utiliser la méthode choisirAttaque
    public function attaquer($cible) {
        $action = $this->choisirAttaque();

        if ($action == 1) {
            // Attaque normale
            $cible->prendreDegats($this->niveau_puissance + $this->pouvoir_special);
        } elseif ($action == 2) {
            // Se défendre
            echo $this->nom . " se défend!\n";
        }
    }
}
// Fonction pour afficher les statistiques d'un personnage
include 'index.php';
?>