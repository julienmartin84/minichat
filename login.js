function setCookie(cname, cvalue, days) {
    var d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ';path=/';
}

function setPseudoCookie() {
    setCookie('pseudo', document.getElementById('pseudo').value, 3);
    window.location.replace('minichat.php');
}

window.onload = function() {
    document.getElementById('setPseudo').addEventListener('click', setPseudoCookie);
};