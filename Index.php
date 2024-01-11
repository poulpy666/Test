<?php  //on mets pas l'option quitter au début mais à la fin d'un combat sinon,
    
    // Menu principal du jeu
    function Partie(){//
        do{ 
            //Selection personnage
            function ChoixPerso(){
                include 'Personnage.php';
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
            ChoixPerso();
        
           function Ennemi(){
                include 'Personnage.php';
                $randm=rand(1,3);
                if($randm==1){
                    echo"Vous allez affronter: ".affichagenom($freezer); 
                }
                elseif($randm==2){
                    echo"Vous allez affronter: ".affichagenom($cell); 
                }
                elseif($randm==3){
                echo"Vous allez affronter: ".affichagenom($buu); 
                }
             }
          Ennemi();
            $stopouencore= readline("1 pour continuer, 2 pour quitter :");
        }  while($stopouencore!=2);
    //fin partie
    }//on touche pas à cette acollade elle englobe toute la partie    

    Partie();//la function Partie englobe tout le déroulement des combats et le jeu en globalité

    // A FAIRE : changer pv nom ennemis et heros (nomf nomgk etc...);ennemi random et système combat 

?>


