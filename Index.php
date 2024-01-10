<?php 
include 'Personnage.php';
    // Menu principal du jeu
echo "Bienvenue, choisis un de ces trois personages: \n";
ChoixPerso();
function ChoixPerso(){
    $choixperso = readline("1 Goku 2 Gohan 3 Vegeta: ");

    if($choixperso==1){
      $goku = new Heros($n);
      echo $goku -> getGoku();

    }elseif($choixperso==2){
        $gohan = new Heros($n);
        echo $gohan -> getGohan();

    }elseif($choixperso==3){
       $vegeta = new Heros($n);
       echo $vegeta -> getVegeta();
       }
    elseif($choixperso != 1 or 2 or 3){

       //Faire une loop pour retourner sur le choix
    }
} 

?>