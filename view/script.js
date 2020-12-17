//auto refresh user message
/*var auto_refresh_user = setInterval(
    function () {
        $('#box').load('box.php').fadeIn("slow");
    }, 1000);
//auto refresh other message
var auto_refresh_other = setInterval(
    function () {
        $('#otherMessage').load('..\model\Message.php').fadeIn("slow");
    }, 1000);*/


function writeInDiv(text) {
    var objet = document.getElementById('box');
    objet.innerHTML = text;
}

function ajax() {
    var xhr = null;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("GET", "../model/Message.php", false);
    xhr.send(null);
    writeInDiv(xhr.responseText);
    setInterval("ajax()", 1000);
}

//Scrollbar en bas par défaut.
scrollDown = document.getElementById('box');
scrollDown.scrollTop = scrollDown.scrollHeight;