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


function writeInDiv(reponseArray) {
    var objet = document.getElementById('box');
    objet.innerHTML = reponseArray;
}
//Scrollbar en bas par défaut (initial).
scrollDown = document.getElementById('box');
scrollDown.scrollTop = scrollDown.scrollHeight;

function ajax() {
    var xhr = null;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200 && this.response != false) {
            writeInDiv(this.responseText);
            scrollDown = document.getElementById('box');
            scrollDown.scrollTop = scrollDown.scrollHeight;
            console.log('!new msg!');
        }
        else{
            console.log('no new msg');
        }
    };
    xhr.open("GET", "./index.php?action=refresh", true);
    xhr.send(null);
    setTimeout(ajax, 5000);
}
ajax();