<?php

//test de la présence des deux variables de post
if ( isset($_POST['pseudo']) && isset($_POST['message']) ){
    //test si pseudo et message ne sont pas vides
    if ( !empty($_POST['pseudo']) && !empty($_POST['message']) ) {
        $pseudo = $_POST['pseudo'];
        $message = $_POST['message'];

        //les deux paramètres sont valides pour passer en base
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=databasename;charset=utf8', 'username', 'password');
        } catch(Exception $e)
        {
            die();
        }
        $requete = $bdd->prepare('insert into minichat (pseudo, message) values(:pseudo, :message);');
        $requete->execute(array('pseudo'=>$pseudo, 'message'=>$message));
        $requete->closeCursor();
    }
}

?>