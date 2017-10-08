<!DOCTYPE html>
<html>
<head>
    <title>minichat</title>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="images/logo.png" />
    <link rel="stylesheet" type="text/css" href="minichatstyle.css">
    <script src="login.js"></script>
</head>

<body>

<?php

if (isset($_COOKIE['pseudo'])) {
    header('Location: minichat.php');
} else {
?>

<form id="form">
    <table>
        <tr>
            <td><label for="pseudo">pseudo : </label> </td>
            <td><input type="text" id="pseudo" name="pseudo" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="button" id="setPseudo" value="Envoyer" /></td>
        </tr>
    </table>
</form>

<?php
}
?>

</body>

</html>