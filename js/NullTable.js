function nullTable() {
    $('#table').html(`<tr>
        <th>Result</th>
        <th>X</th>
        <th>Y</th>
        <th>R</th>
        <th>Current Time</th>
        <th>Script time</th>
        </tr>`);

    $.ajax({
        type: "POST",
        url: '../php/index.php',
        async: false,
        data: { "clearF": "true"},
        success: function (data) {
            console.log("cleared");
        },
        error: function (xhr, textStatus, err) {
            alert("readyState: " + xhr.readyState + "\n"+
                "responseText: " + xhr.responseText + "\n"+
                "status: " + xhr.status + "\n"+
                "text status: " + textStatus + "\n" +
                "error: " + err);
        }
    });

}