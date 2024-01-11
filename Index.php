<?php  //on mets pas l'option quitter au début mais à la fin d'un combat sinon,
    include 'Personnage.php';
    // Menu principal du jeu
    
        do{ 
            //Selection personnage
            function ChoixPerso($goku,$gohan,$vegeta){
                
                $choixperso = readline("1 Goku 2 Gohan 3 Vegeta:");
                // FAIRE UNE BOUCLE POUR LE CHOIX!
                        if($choixperso==1){
                        affichagedata($goku);  
                    }
                    elseif($choixperso==2){
                       affichagedata($gohan);   
                    }
                    elseif($choixperso==3){
                       affichagedata($vegeta);
                    }
                    else{
                        echo "Vous devez faire un choix \n";
                    }
            }
            echo "Bienvenue dans DragonBall typing fighters Z, choisis un de ces trois personages: \n";
            //lancement function ChoixPerso
           function Ennemi($freezer,$cell,$buu){
                $randm=rand(1,3);
                if($randm==1){
                    echo affichagenom($freezer); 
                }
                elseif($randm==2){
                    echo affichagenom($cell); 
                }
                elseif($randm==3){
                echo affichagenom($buu); 
                }
             }
             ChoixPerso($goku,$gohan,$vegeta);
             Ennemi($freezer,$cell,$buu);
            $stopouencore= readline("1 pour continuer, 2 pour quitter :");
        }while($stopouencore!=2);
        
    //on touche pas à cette acollade elle englobe toute la partie    
    // A FAIRE : ennemi random et système combat 

?>


