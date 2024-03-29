<?php
include 'index.php';

function afficher_statistiques($personnage) {
    // Ajout d'une vérification pour n'afficher que les statistiques du vainqueur
    if ($personnage->points_vie > 0) {
        echo "Statistiques de ".$personnage->nom.":\n";
        echo "Niveau de puissance: ".$personnage->niveau_puissance."\n";
        echo "Points de vie: ".$personnage->points_vie."\n";
    }
}

function choisirPersonnage($personnages, $type) {
    //$type=(Hero ou Mechant)
    do {
        echo "Choisissez un $type pour le combat :\n";
        foreach ($personnages as $key => $personnage) {
            $key++;// pour faire commencer la selection des personnage a partir 1
            echo "$key: " .$personnage->nom ."\n";
        }
        $choix = readline("Entrez le numéro du $type que vous souhaitez utiliser : ");
        if (!isset($personnages[$choix - 1])) { // verifie que la selection de personnage est possible (si 2 restants pas pouvoir selectionner 3)
            echo "Choix invalide. Veuillez entrer un numéro valide.\n";
        }

    } while (!isset($personnages[$choix - 1]));//ce while permet d'afficher seulement les personnages restant
    return $personnages[$choix - 1];
}

function combat($personnage1, $personnage2) {
    echo "Début du combat entre ".$personnage1->nom." et ".$personnage2->nom."!\n";
    // Affichage des stats avant le combat
    afficher_statistiques($personnage1);
    afficher_statistiques($personnage2);
    while ($personnage1->points_vie > 0 && $personnage2->points_vie > 0) {
        $actionPersonnage1 = $personnage1->choisirAttaque();
        
        if ($actionPersonnage1 == 1 || $actionPersonnage1 == 2) {
            $personnage1->attaquer($personnage2, $actionPersonnage1);//dans ce cas les deux personnages attaquent
        } elseif ($actionPersonnage1 == 3) {
            // Le heros se défend de l'attaque ennemie
            $personnage1->seDefendre($personnage2);
        } else {
            echo "Action invalide. Veuillez entrer un numéro entre 1 et 3.\n";
            continue; // Revient au début de la boucle pour permettre une nouvelle saisie
        }
        // Affichage unique des points de vie
        echo "Points de vie de ".$personnage2->nom.": ".$personnage2->points_vie."\n";
        if ($personnage2->points_vie <= 0) {
            echo $personnage2->nom." a été vaincu!\n";
            break;
        }
        $personnage2->attaquer($personnage1);// ennemi -> attaque --> perso
        // Afficher uniquement les points de vie
        echo "Points de vie de ".$personnage1->nom.": ".$personnage1->points_vie."\n";    
        if ($personnage1->points_vie <= 0) {
            echo $personnage1->nom." a été vaincu!\n";
            break;
        }
    }
// Affichage des statistiques complètes après le combat que du vainqueur
    if ($personnage1->points_vie > 0) {
        afficher_statistiques($personnage1);
        $personnage1->gagnerCombat(); // Placé ici pour ne l'appeler que si le Hero a gagné
        echo $personnage1->nom . " a débloqué l'attaque ultime 'Kamehameha' et sa puissance a augmenté!\n";
    } elseif ($personnage2->points_vie > 0) {
        afficher_statistiques($personnage2);
    }
    echo "Fin du combat!\n";
}

$goku = new Hero("Goku", 10000, 500, 200);
$vegeta = new Hero("Vegeta", 9500, 480, 180);
$piccolo = new Hero("Piccolo", 9200, 550, 160);

$freezer = new Mechant("Freezer", 8500, 550, 250);
$cell = new Mechant("Cell", 9000, 530, 220);
$buu = new Mechant("Majin Buu", 9200, 600, 200);

$herosDisponibles = [$goku, $vegeta, $piccolo];
$mechantsDisponibles = [$freezer, $cell, $buu];

$nombreMechantsVaincus = 0;

for ($i = 0; $i < 3; $i++) {
    $heroChoisi = choisirPersonnage($herosDisponibles, "héros");
    $mechantChoisi = choisirPersonnage($mechantsDisponibles, "méchant");

    $keyToRemove = array_search($mechantChoisi, $mechantsDisponibles);
    $keyToRemove1 = array_search($heroChoisi, $herosDisponibles);

    if ($keyToRemove !== false && $keyToRemove1 !== false) {
        unset($mechantsDisponibles[$keyToRemove]);
        unset($herosDisponibles[$keyToRemove1]);
    }
    combat($heroChoisi, $mechantChoisi);

    if ($heroChoisi->points_vie > 0) {
        afficher_statistiques($heroChoisi);
    } elseif ($mechantChoisi->points_vie > 0) {
        afficher_statistiques($mechantChoisi);
        $nombreMechantsVaincus++;
    }
}

$nombreTotalMechants = count($mechantsDisponibles);
// definit si les méchants ont été vaincus.
if ($nombreMechantsVaincus == $nombreTotalMechants) {
    echo "Vous avez gagné! :) ";
} else {
    echo "Les héros ont perdu :( ";
}
?>