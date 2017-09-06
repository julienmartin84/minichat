<?php

//recuperation de lastId
if ( isset($_GET['lastId']) ) {
    $lastId = htmlspecialchars($_GET['lastId']);
} else {
    $lastId = -1;
}

//connexion à la bdd
$bdd = new PDO('mysql:host=localhost;dbname=databasename;charset=utf8', 'username', 'password');

if ($lastId == -1) {
    $requete = $bdd->query('select id, pseudo, message from minichat order by id desc');
    $maxId = 0;
} else {
    $requete = $bdd->prepare('select id, pseudo, message from minichat where id > ? order by id desc');
    $requete->execute(array($lastId));
    $maxId = $lastId;
}

while ($data=$requete->fetch()) {
    if ($data['id'] > $maxId) {
        $maxId = $data['id'];
    }
    echo '<span class="pseudo">' . $data['pseudo'] . ' : </span><span> ' . $data['message'] . '</span> <br />';
}
$requete->closeCursor();

if ($maxId > $lastId) {
    echo '<p class="lastId">' . $maxId . '</p>';
}

?>