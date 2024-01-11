<?php

class Personnage {
    public $nom;
    public $niveau_puissance;
    public $points_vie;

    public function __construct($nom, $niveau_puissance, $points_vie) {
        $this->nom = $nom;
        $this->niveau_puissance = $niveau_puissance;
        $this->points_vie = $points_vie;
    }

    public function prendreDegats($degats) {
        $this->points_vie -= $degats;
        if ($this->points_vie <= 0) {
            $this->mourir();
        }
    }

    public function mourir() {
        echo $this->nom . " est vaincu!\n";
    }
}

class Hero extends Personnage {
    public $super_pouvoir;
    private $attaque_speciale_debloquee = false;

    public function __construct($nom, $niveau_puissance, $points_vie, $super_pouvoir) {
        parent::__construct($nom, $niveau_puissance, $points_vie);
        $this->super_pouvoir = $super_pouvoir;
    }

    public function choisirAttaque() {
        echo "Choisissez une attaque pour " . $this->nom . " :\n";
        echo "1: Attaque normale\n";
        echo "2: Attaque spéciale\n";
        echo "3: Se défendre\n";

        $choix = readline("Entrez le numéro de l'attaque que vous souhaitez utiliser : ");
        return $choix;
    }
    public function attaquer($cible) {
        if ($this->attaque_speciale_debloquee) {
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
function afficher_statistiques($personnage) {
    echo "Statistiques de " . $personnage->nom . ":\n";
    echo "Niveau de puissance: " . $personnage->niveau_puissance . "\n";
    echo "Points de vie: " . $personnage->points_vie . "\n";

    if ($personnage instanceof Hero) {
        echo "Super Pouvoir: " . $personnage->super_pouvoir . "\n";
    } elseif ($personnage instanceof Mechant) {
        echo "Pouvoir Spécial: " . $personnage->pouvoir_special . "\n";
    }
}

// Fonction pour simuler un combat entre deux personnages
function combat($personnage1, $personnage2) {
    echo "Début du combat entre " . $personnage1->nom . " et " . $personnage2->nom . "!\n";

    while ($personnage1->points_vie > 0 && $personnage2->points_vie > 0) {
        // Le joueur choisit son attaque pour le Personnage 1
        $actionPersonnage1 = $personnage1->choisirAttaque();
        
        if ($actionPersonnage1 == 1) {
            $personnage1->attaquer($personnage2);
        } elseif ($actionPersonnage1 == 2) {
            // Le personnage se défend 
        } else {
            echo "Action invalide. Le personnage attaquera par défaut.\n";
            $personnage1->attaquer($personnage2);
        }

        afficher_statistiques($personnage2);

        // Vérifier si Personnage 2 est toujours en vie
        if ($personnage2->points_vie <= 0) {
            echo $personnage2->nom . " a été vaincu!\n";
            break;
        }

        // Le méchant effectue une action aléatoire
        $personnage2->attaquer($personnage1);

        afficher_statistiques($personnage1);

        // Vérifier si Personnage 1 est toujours en vie
        if ($personnage1->points_vie <= 0) {
            echo $personnage1->nom . " a été vaincu!\n";
            break;
        }
    }

    echo "Fin du combat!\n";
}

// Création des héros
$goku = new Hero("Goku", 10000, 500, 200);
$vegeta = new Hero("Vegeta", 9500, 480, 180);
$piccolo = new Hero("Piccolo", 9200, 550, 160);

// Création des méchants
$freezer = new Mechant("Freezer", 8500, 550, 250);
$cell = new Mechant("Cell", 9000, 530, 220);
$buu = new Mechant("Majin Buu", 9200, 600, 200);

// Tableaux pour stocker les héros et les méchants disponibles
$herosDisponibles = [$goku, $vegeta, $piccolo];
$mechantsDisponibles = [$freezer, $cell, $buu];

// Boucle pour trois combats
for ($i = 0; $i < 3; $i++) {
    // Sélectionner un héros et un méchant
$heroChoisi = choisirPersonnage($herosDisponibles, "héros");
$mechantChoisi = choisirPersonnage($mechantsDisponibles, "méchant");

// Trouver la clé de l'élément à supprimer dans le tableau des méchants
$keyToRemove = array_search($mechantChoisi, $mechantsDisponibles);

// Vérifier si l'élément a été trouvé avant de le supprimer
if ($keyToRemove !== false) {
    unset($mechantsDisponibles[$keyToRemove]);
}

// Simuler le combat
combat($heroChoisi, $mechantChoisi);
}

// Fonction pour permettre au joueur de choisir un personnage
function choisirPersonnage($personnages, $type) {
    echo "Choisissez un $type pour le combat :\n";
    foreach ($personnages as $key => $personnage) {
        echo "$key: " . $personnage->nom . "\n";
    }

    $choix = readline("Entrez le numéro du $type que vous souhaitez utiliser : ");
    return $personnages[$choix];
}
?>