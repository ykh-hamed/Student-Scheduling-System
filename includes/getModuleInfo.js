$(document).click(function (event) {
    var text = event.target.tagName;
    if (text == "TD") {
        getModuleInfo($(event.target).text());
    }
});


function getModuleInfo(module) {
    <!--get info of the module from the db and display -->
    document.getElementById("moduleInfo").innerHTML = '<h2>Module information:</h2>' + "<h4>" + module + "</h4>";
}