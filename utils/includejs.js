function include(js){
    var script=document.createElement("script");
    script.type="text/javascript";
    script.src=js;
    document.head.appendChild(script);
}
//include("js/jquery-2.1.0.min.js");
//include("js/jquery-ui.min.js");