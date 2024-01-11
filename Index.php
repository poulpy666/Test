<?php  //on mets pas l'option quitter au début mais à la fin d'un combat sinon,
    
    // Menu principal du jeu
    function Partie(){
        do{ 
            //Selection personnage
            function ChoixPerso(){
                include 'Personnage.php';
                $choixperso = readline("1 Goku 2 Gohan 3 Vegeta: ");
                switch($choixperso){
                    case 1:
                        if($choixperso==1){
                        affichagedata($goku);
                    }
                    case 2:
                        if($choixperso==2){
                       affichagedata($gohan);
                        break;
                    }
                    case 3:
                    if($choixperso==3){
                       affichagedata($vegeta);
                        break;
                    }
                    case 4:
                    if($choixperso != 1 or 2 or 3 or 4){
                    
                        echo "Vous devez faire un choix \n";
                    }
                    
                } 
            }
            echo "Bienvenue dans DragonBall typing fighters Z, choisis un de ces trois personages: \n";
            //lancement function ChoixPerso
            ChoixPerso();
        
           /* function Ennemi(){
                $randm= rand(1,3);
                    if ($randm==1) {
                        
                            $freezer = new Mechants();
                            echo "Tu vas affronter $-> getFreezer()." est ton adversaire\n";
                            break;
                        case 2:
                            $cell= new Mechants();
                            echo $cell-> getCell()." est ton adversaire\n";
                            break;
                        case 3:
                            $buu= new Mechants();
                            echo $buu -> getBuu()." est ton adversaire\n";
                            break;
                    }   
            }*/
            $stopouencore= readline("1 pour continuer, 2 pour quitter :");
        }  while($stopouencore!=2);
    //fin partie
    }//on touche pas à cette acollade elle englobe toute la partie    

    Partie();//la function Partie englobe tout le déroulement des combats et le jeu en globalité

    // A FAIRE : changer pv nom ennemis et heros (nomf nomgk etc...);ennemi random et système combat 

?>


