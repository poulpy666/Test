<?php

class Personnage {
    public $nom;
    public $sexe;
    public $classe;
    public $pv;
    public $attaque;
    public $potion_utilisee;
    public $defense;

    public function __construct($nom, $sexe, $classe) {
        $this->nom = $nom;
        $this->sexe = $sexe;
        $this->classe = $classe;

        if ($classe == "G") {
            $this->pv = 50;
            $this->attaque = 8;
        } elseif ($classe == "M") {
            $this->pv = 25;
            $this->attaque = 16;
        } elseif ($classe == "A") {
            $this->pv = 35;
            $this->attaque = 12;
        } else {
            $this->pv = rand(20, 40);
            $this->attaque = rand(5, 15);
            $this->classe = "R";
        }

        $this->potion_utilisee = false;
        $this->defense = false;
    }

    public function attaquer($cible) {
        // Function to make the character attack
        if (!$this->defense) {
            $cible->recevoir_degats($this->attaque);
        } else {
            $cible->recevoir_degats($this->attaque / 2);
            echo $this->nom. " se défend et inflige " .($this->attaque / 2). " dégâts à " .$cible->nom. " !\n";
            $this->defense = false;
        }
    }

    public function defendre() {
        // Function to make the character enter defense mode
        $this->defense = true;
        echo $this->nom." se met en position de défense.\n";
    }

    public function utiliser_potion() {
        // Function to make the character use a healing potion
        if ($this->potion_utilisee) {
            echo "Vous avez déjà utilisé une potion ce tour-ci.\n";
        } else { // if the character has not used a potion, they gain 25 health points (up to a maximum of 50) and the potion variable is set to true
            $this->pv += 25;
            if ($this->pv > 50) {
                $this->pv = 50;
            }
            $this->potion_utilisee = true;
            echo "Vous avez utilisé une potion et avez récupéré 25 points de vie.\n";
        }
    }
    public function recevoir_degats($degats) {
        // Function to make the character receive damage
        $this->pv -= $degats;
        echo $this->nom. " subit ".$degats." dégâts.\n";
        if ($this->pv <= 0) {
            echo $this->nom. " a perdu le combat !\n";
        }
    }
}
class Ennemi {
    public $nom;
    public $pv;
    public $degat;
    
    public function __construct($nom, $pv, $degat) {
        $this->nom = $nom;
        $this->pv = $pv;
        $this->degat = $degat;
    }
    public function generer_ennemis_aleatoires() {
        // Array of enemy names, genders, health points, and attack points
        $ennemis = [
            ["Dracula", "M", 30, 5],
            ["Miss Pacman", "F", 12, 3],
            ["StarFox", "M", 17, 6],
            ["Goblin", "M", 10, 2],
            ["Ogre", "M", 20, 8]
        ];
        $nb_ennemis = rand(1, 3);
        $liste_ennemis = [];
        // Loop to generate the enemies and add them to the array
        for ($i = 0; $i < $nb_ennemis; $i++) {     // Select a random enemy from the array, add the new enemy to the array and create a new Ennemi object with the selected enemy's attributes
            $ennemi = $ennemis[array_rand($ennemis)];
            $nouvel_ennemi = new Ennemi($ennemi[0], $ennemi[2], $ennemi[3]);
            $liste_ennemis[] = $nouvel_ennemi;
        }
        return $liste_ennemis;
    }
    public function attaquer($perso){
        // Function to attack the player and decrease their health points
        $degats_infliges = rand(1, $this->degat);
        echo $this->nom." attaque ".$perso->nom." et inflige ".$degats_infliges." points de dégâts!\n";
        $perso->pv -= $degats_infliges;
        if ($perso->pv <= 0) {
            echo $perso->nom." a été vaincu!\n";
        }
    }
    
    public function subir_degats($degats) {
        // Function to decrease the enemy health points after being attacked
        $this->pv -= $degats;
        echo $this->nom. " subit " .$degats. " dégâts.\n";
        if ($this->pv <= 0) {
            echo $this->nom. " a été vaincu!\n";
        }
    }
    public function recevoir_degats($degats) {
        // Function to decrease the enemy health points after being attacked, used in multi-player mode
        $this->pv -= $degats;
        if ($this->pv <= 0) {
            echo $this->nom. " est mort !\n";
        } else {
            echo $this->nom. " a maintenant " .$this->pv. " points de vie.\n";
        }
    }
}
// Define a function to load data from a file
function load_data($filename) {
    $data = array();
    if (file_exists($filename)) {
        $data = unserialize(file_get_contents($filename));
    }
    return $data;
}
// Define a function to save data to a file
function save_data($filename, $data) {
    file_put_contents($filename, serialize($data));
}

/* GAME SIMULATION */

$load = readline("Voulez-vous charger une partie existante ? (O/N) : ");
if (strtolower($load) == "o") {
    // Load the existing game
    $data = load_data('save.txt');
    $perso = new Personnage($data['nom'], $data['sexe'], $data['classe']);
    $nom = $data['nom'];
    $sexe = $data['sexe'];
    $classe = $data['classe'];
    $pv = $data['pv'];
    $degat = $data['degat'];
    $niveau = $data['niveau'];
    $nb_combats = $data['nb_combats'];
    } else {
        $nom = readline("Entrez votre nom: ");
        $sexe = readline("Entrez votre sexe (M/F) : ");
        $classe = '';
        while (!in_array($classe, ['G', 'M', 'A', 'R'])) {
            $classe = readline("Choisissez votre classe [(G)uerrier, (M)age, (A)rcher, ou (R)andom] : ");
            $classe = strtoupper($classe);
        }
        if ($classe == "G") {
            $pv = 50;
            $degat = 8;
        } elseif ($classe == "M") {
            $pv = 25;
            $degat = 16;
        } elseif ($classe == "A") {
            $pv = 35;
            $degat = 12;
        } else {
            $pv = rand(20, 40);
            $degat = rand(5, 15);
            $classe = "R";
        }
        $perso = new Personnage($nom, $sexe, $classe);
    }

// Create an enemy 
$ennemi = new Ennemi("Dracula", 30, 5);
// Generate a list of random enemies
$liste_ennemis = $ennemi->generer_ennemis_aleatoires();

$nb_combats = 0;
foreach ($liste_ennemis as $ennemi) {               // Loop through each enemy in the list

    echo "Vous affrontez ".$ennemi->nom." (PV: ".$ennemi->pv.", Dégâts: ".$ennemi->degat.")\n";
    $niveau = 1;
    while ($perso->pv > 0 && $ennemi->pv > 0) {
        echo "Tour suivant :\n";
        $perso->attaquer($ennemi);
        if ($ennemi->pv > 0) {                   // While both player and enemy have HP
            $action_ennemi = rand(0, 1);
            
            if ($action_ennemi == 1) {          //If the number is 1, the enemy attacks
                $ennemi->attaquer($perso);
            } else {                            // Otherwise, the enemy does nothing
                echo "L'ennemi n'a rien fait ce tour-ci.\n";
            }
        }
        // Check if the player and enemy have remaining health and if the player has not used a potion
        if ($perso->pv > 0 && !$perso->potion_utilisee && $ennemi->pv > 0) {
            echo "Que voulez-vous faire ? (A)ttack, (D)efend, (P)otion : ";
            $reponse = strtolower(readline());
            if ($reponse == "a") {               // If the player chooses to attack, call the attack method on the player object
                $perso->attaquer($ennemi);
            } elseif ($reponse == "d") {         // If the player chooses to defend, call the defend method on the player object
                $perso->defendre();
                if ($ennemi->pv > 0) {           // If the enemy has remaining health after the player defends, reduce its health by half the player's attack value
                    $degats_infliges = $perso->attaque / 2;
                    $ennemi->subir_degats($degats_infliges);
                    echo "Vous vous êtes défendu et avez infligé ".$degats_infliges." dégâts à l'ennemi.\n";
                } else {                         // If the enemy has no remaining health after the player defends
                    echo "Vous vous êtes défendu.\n";
                }
            } elseif ($reponse == "p") {          // If the player chooses to use a potion, call the use potion method on the player object
                $perso->utiliser_potion();
            } else {                            // If the player's response is invalid
                echo "Réponse invalide.\n";
            }
        }
        if ($perso->pv <= 0) {                  // If the player has been defeated
            echo "Vous avez été vaincu par ".$ennemi->nom."...\n";
            exit();                             // End the game
        }
        if ($ennemi->pv <= 0) {                 // If the enemy has been defeated
            echo "Vous avez vaincu ".$ennemi->nom." !\n";
            $nb_combats++;
            if ($nb_combats >= pow(2, $niveau-1)) {         // If the player has fought enough battles to level 
                $niveau++;
                $perso->pv += 3;
                $perso->attaque += 2;
                $nb_combats = 0; // Reset the number of battles fought required for next level up to 0
                echo "Vous avez atteint le niveau ".$niveau." ! Votre vie a augmenté de 3 et votre attaque de 2.\n";
            }
        }
        // Save Data
        $data = array('nom' => $nom, 'sexe' => $sexe, 'classe' => $classe, 'pv' => $pv, 'degat' => $degat, 'niveau' => $niveau, 'nb_combats' => $nb_combats);
        save_data('save.txt', $data);
    }
}
?>