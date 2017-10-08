<!DOCTYPE html>
<html>
    <head>
        <title>minichat</title>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="images/logo.png" />
        <link rel="stylesheet" type="text/css" href="minichatstyle.css">
        <script src="minichat.js"></script>
        <script src="jquery-3.2.1.min.js"></script>
    </head>

    <body>

    <?php

    if (!isset($_COOKIE['pseudo'])) {
        header('Location: login.php');
    }
    ?>

    <p id="welcomeMessage"></p>

    <div id="conteneur">
        <div id="messages"></div>
    </div>

    <form id="form">
        <textarea id="message" name="message" title="Write your message here"></textarea>
        <br />
        <input type="button" id="sendButton" value="Envoyer" />
        <span id="infoMessage"></span>
    </form>

    </body>

</html>