<?php 
    include 'Personnage.php';
    // Menu principal du jeu
    function Partie(){
        //do{
        //Selection personnage
        function ChoixPerso(){
            $choixperso = readline("1 Goku 2 Gohan 3 Vegeta: ");
            switch(){
                    case 1:
                        if($choixperso==1){
                    $goku = new Heros();
                    echo $goku -> getGoku()." a été selectionné\n";
                    }
                    case 2:
                        if($choixperso==2){
                        $gohan = new Heros();
                        echo $gohan -> getGohan()." a été selectionné\n";

                    }
                    case 3:
                        if($choixperso==3){
                        $vegeta = new Heros();
                        echo $vegeta -> getVegeta()." a été selectionné\n";
                    }
                    case 4:
                        if($choixperso != 1 or 2 or 3 or 4){
                        echo "Vous devez faire un choix \n";
                        //Faire une loop pour retourner sur le choix
                    }
                    case 5: 
                        if($choixperso==4){
                        break;
                    }
                } 
                echo "Bienvenue dans DragonBall typing fighters Z, choisis un de ces trois personages ou quittez le jeu: \n";
                //lancement function ChoixPerso
                ChoixPerso();
            } 
            function Ennemi(){

            }
        }
    }
    Partie();//la function Partie englobe tout le déroulement des combats et le jeu en globalité
?>