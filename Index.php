<?php
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
do{
    function combat($personnage1, $personnage2) {
        echo "Début du combat entre " . $personnage1->nom . " et " . $personnage2->nom . "!\n";

        while ($personnage1->points_vie > 0 && $personnage2->points_vie > 0) {
            // Le joueur choisit son attaque pour le Personnage 1
            $actionPersonnage1 = $personnage1->choisirAttaque();
            
            if ($actionPersonnage1 == 1) {
                $personnage1->attaquer($personnage2);
            } elseif ($actionPersonnage1 == 2) {
                // Le personnage se défend //attaque spé
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
        echo "Voulez-Vous 1-Continuer ou 2-Quitter?";
    }
}while($eccdc);

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
}?>