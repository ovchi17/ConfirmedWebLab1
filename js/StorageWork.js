window.addEventListener('load', function() {
    $.ajax({
        type: "POST",
        url: '../php/index.php',
        async: false,
        data: { "onLoad": "true"},
        success: function (data) {
            uploadData(data);
            console.log("dataDone");
        },
        error: function (xhr, textStatus, err) {
            alert("readyState: " + xhr.readyState + "\n"+
                "responseText: " + xhr.responseText + "\n"+
                "status: " + xhr.status + "\n"+
                "text status: " + textStatus + "\n" +
                "error: " + err);
        }
    });
});


function uploadData(data) {
    const table = document.getElementById('table');
    table.innerHTML = data;
}