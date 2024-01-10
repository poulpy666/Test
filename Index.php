<?php 
    include 'Personnage.php';
    // Menu principal du jeu
    function Partie(){
        do{
            function ChoixPerso(){
                $choixperso = readline("1 Goku 2 Gohan 3 Vegeta: ");

                if($choixperso==1){
                $goku = new Heros();
                echo $goku -> getGoku()." a été selectionné\n";

                }elseif($choixperso==2){
                    $gohan = new Heros();
                    echo $gohan -> getGohan()." a été selectionné\n";

                }elseif($choixperso==3){
                $vegeta = new Heros();
                echo $vegeta -> getVegeta()." a été selectionné\n";
                }
                elseif($choixperso != 1 or 2 or 3 or 4){
                    echo "Vous devez faire un choix \n";
                //Faire une loop pour retourner sur le choix
                }
                elseif($choixperso==4){
                    break;
                }
            } 
            echo "Bienvenue dans DragonBall typing fighters Z, choisis un de ces trois personages ou quittez le jeu: \n";
            ChoixPerso();
        } while (1==1);
        
    }
    Partie();
?>