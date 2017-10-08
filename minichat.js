var isMsgLengthValid = true;
var refreshId;
var lastId = null;

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkMsgLength() {
    var msgLength = document.getElementById("message").value.length;
    var charLeft = 255 - msgLength;
    if (msgLength > 255 && isMsgLengthValid) {
        document.getElementById("sendButton").setAttribute("disabled", true);
        isMsgLengthValid = false;
        document.getElementById("message").style.backgroundColor = '#d9534f';
        document.getElementById("message").style.color = 'white';
        document.getElementById("infoMessage").textContent = "Votre message compte "+msgLength+" caractères et dépasse les 255 autorisés";
        document.getElementById("infoMessage").style.color = '#d9534f';
    } else if (msgLength <= 255 && !isMsgLengthValid) {
        document.getElementById("sendButton").removeAttribute("disabled");
        isMsgLengthValid = true;
        document.getElementById("message").style.backgroundColor = 'white';
        document.getElementById("message").style.color = 'black';
        document.getElementById("infoMessage").textContent = charLeft+" caractères restants";
        document.getElementById("infoMessage").style.color = 'black';
    } else if (msgLength > 255 && !isMsgLengthValid) {
        document.getElementById("infoMessage").textContent = "Votre message compte "+msgLength+" caractères et dépasse les 255 autorisés";
    } else if (msgLength <= 255) {
        document.getElementById("infoMessage").textContent = charLeft+" caractères restants";
    }
    if (charLeft === 1 || charLeft === 0) {
        document.getElementById("infoMessage").textContent = charLeft+" caractère restant";
    }
}

function updateMessages(data) {
    var serverAnswer = JSON.parse(data);
    if (lastId === serverAnswer.maxId) {
    } else {
        lastId = serverAnswer.maxId;
        serverAnswer.messages.forEach( function (message) {
            document.getElementById("messages").innerHTML = document.getElementById("messages").innerHTML + message;
        });
        var scrollableDiv = document.getElementById('messages');
        $('#messages').animate({
            scrollTop: scrollableDiv.scrollHeight - scrollableDiv.clientHeight
        }, 500);
    }
}

function getMessages() {
    if (lastId === null) {
        ajaxGet('getMessages.php', updateMessages);
    } else {
        ajaxGet('getMessages.php?lastId='+lastId, updateMessages);
    }
}

function ajaxGet(url, callback) {
    var req = new XMLHttpRequest();
    req.open("GET", url);
    req.addEventListener("load", function () {
        if (req.status >= 200 && req.status < 400) {
            // Appelle la fonction callback en lui passant la réponse de la requête
            callback(req.responseText);
        } else {
            console.error(req.status + " " + req.statusText + " " + url);
        }
    });
    req.addEventListener("error", function () {
        console.error("Erreur réseau avec l'URL " + url);
    });
    req.send(null);
}

function ajaxPost(url, data, callback) {
    var req = new XMLHttpRequest();
    req.open("POST", url);
    req.addEventListener("load", function () {
        if (req.status >= 200 && req.status < 400) {
            // Appelle la fonction callback en lui passant la réponse de la requête
            callback(req.responseText);
        } else {
            console.error(req.status + " " + req.statusText + " " + url);
        }
    });
    req.addEventListener("error", function () {
        console.error("Erreur réseau avec l'URL " + url);
    });
    req.send(data);
}

function postMessage() {
    document.getElementById('infoMessage').textContent = '';
    document.getElementById("sendButton").setAttribute("disabled", true);
    var form = document.getElementById("form");
    var data = new FormData(form);
    data.append("pseudo", getCookie('pseudo'));

    ajaxPost("minichat_post.php", data, function(){});
    document.getElementById("message").value = "";
    document.getElementById("message").focus();
    document.getElementById("sendButton").removeAttribute("disabled");
}

window.onload = function() {
    document.getElementById('message').focus();
    document.getElementById('welcomeMessage').textContent = 'Bienvenue '+getCookie('pseudo')+'.';
    getMessages();
    document.getElementById("message").addEventListener("keyup", checkMsgLength);
    document.getElementById("sendButton").addEventListener("click", postMessage);
    refreshId = setInterval(getMessages, 3000);
};