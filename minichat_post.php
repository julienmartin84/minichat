<?php

//test de la présence des deux variables de post
if ( isset($_POST['pseudo']) && isset($_POST['message']) ){
    //test si pseudo et message ne sont pas vides
    if ( !empty($_POST['pseudo']) && !empty($_POST['message']) ) {
        //on echappe les carateres html speciaux eventuels
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $message = htmlspecialchars($_POST['message']);

        //les deux paramètres sont valides pour passer en base
        $bdd = new PDO('mysql:host=localhost;dbname=databasename;charset=utf8', 'username', 'password');
        $requete = $bdd->prepare('insert into minichat (pseudo, message) values(:pseudo, :message);');
        $requete->execute(array('pseudo'=>$pseudo, 'message'=>$message));
        $requete->closeCursor();
    }
}

?>