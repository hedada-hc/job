$(document).ready(function() {
    if(navigator.userAgent.match(/(iPhone|iPad|Android|ios)/i)){
        var theW=window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;
        $("body,html").css({"width": theW,"overflow-x":"hidden"});
    }
});