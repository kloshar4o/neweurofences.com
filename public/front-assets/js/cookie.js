function setCookie(cname, cvalue, exdays = 0) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

$(document).ready(function () {

    if (getCookie('cookie_notice_accepted') != "") {
        $('.cookie').remove();
    } else {
        setTimeout(function () {
            $('.cookie').fadeIn('slow');
        }, 1300);
    }

    $('#cookie-accept').on('click', function (e) {
        e.preventDefault();
        setCookie('cookie_notice_accepted', 'true', 30);
        $('.cookie').remove();
    })

});
