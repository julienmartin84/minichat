<!DOCTYPE html>
<html>
    <head>
        <title>minichat</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="minichatstyle.css">
        <script src="minichat.js"></script>
    </head>

    <body>

    <form id="form">
        <table>
            <tr>
                <td><label for="pseudo">pseudo : </label> </td>
                <td><input type="text" id="pseudo" name="pseudo" /></td>
                <td></td>
            </tr>
            <tr>
                <td><label for="message">message : </label></td>
                <td><input type="text" id="message" name="message" /></td>
                <td><span id="infoMessage"></span></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" id="sendButton" value="Envoyer" /></td>
            </tr>
        </table>
    </form>

    <div id="messages"></div>

    </body>

</html>