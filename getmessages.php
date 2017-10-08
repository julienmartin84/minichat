<?php

header('Content-Type: application/json');

$jsonMessages = new stdClass();
$messages = [];

//recuperation de lastId
if ( isset($_GET['lastId']) ) {
    $lastId = htmlspecialchars($_GET['lastId']);
} else {
    $lastId = -1;
}

try {
    //connexion à la bdd
    $bdd = new PDO('mysql:host=localhost;dbname=databasename;charset=utf8', 'username', 'password');
} catch(Exception $e)
{
    die('Echec de connexion à la base de données, impossible de récupérer les nouveaux messages...<br />');
}

if ($lastId == -1) {
    $requete = $bdd->query('select id, pseudo, message from minichat order by id');
    $jsonMessages->maxId = 0;
} else {
    $requete = $bdd->prepare('select id, pseudo, message from minichat where id > ? order by id');
    $requete->execute(array($lastId));
    $jsonMessages->maxId = $lastId;
}

while ($data=$requete->fetch()) {
    if ($data['id'] > $jsonMessages->maxId) {
        $jsonMessages->maxId = $data['id'];
    }
    $messages[] = '<span class="pseudo">' . htmlspecialchars($data['pseudo']) . ' : </span>' . htmlspecialchars($data['message']) . '<br />';
}
$requete->closeCursor();
$jsonMessages->messages = $messages;

echo json_encode($jsonMessages);

?>