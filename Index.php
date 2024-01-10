<?php  //on mets pas l'option quitter au début mais à la fin d'un combat sinon,
    include 'Personnage.php';
    // Menu principal du jeu
    function Partie(){
        do{ 
            //Selection personnage
            function ChoixPerso(){
                $choixperso = readline("1 Goku 2 Gohan 3 Vegeta: ");
                switch($choixperso){
                    case 1:
                        if($choixperso==1){
                        $goku = new Heros();
                        echo $goku -> getGoku()." a été selectionné\n";
                        break;
                    }
                    case 2:
                        if($choixperso==2){
                        $gohan = new Heros();
                        echo $gohan -> getGohan()." a été selectionné\n";
                        break;
                    }
                    case 3:
                    if($choixperso==3){
                        $vegeta = new Heros();
                        echo $vegeta -> getVegeta()." a été selectionné\n";
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
                    switch ($randm) {
                        case 1:
                            $freezer = new Mechants();
                            echo $freezer -> getFreezer()." est ton adversaire\n";
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
?>