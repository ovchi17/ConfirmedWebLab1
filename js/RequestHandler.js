function  confirmValues(){
    checkInput();
    console.log("We are here");
    console.log(checkInput());
    if (checkInput()){
        console.log("!!!");
        let valueY = document.getElementById("y-value").value;
        let valueR;
        const rButtons = document.getElementsByName('r-value');
        rButtons.forEach(rButtons => {
            if (rButtons.checked){
                valueR = rButtons.value;
            }
        })
        let valueX;
        const buttons = document.querySelectorAll('.button');
        buttons.forEach(button => {
            if (button.classList.contains('active')) {
                valueX = button.dataset.value;
            }
        });

        $.ajax({
            type: "POST",
            url: '../php/index.php',
            async: false,
            data: { "x": valueX, "y": valueY, "r": valueR },
            success: function (data) {
                addElement(data);
            },
            error: function (xhr, textStatus, err) {
                alert("readyState: " + xhr.readyState + "\n"+
                    "responseText: " + xhr.responseText + "\n"+
                    "status: " + xhr.status + "\n"+
                    "text status: " + textStatus + "\n" +
                    "error: " + err);
            }
        });

        console.log(valueX, valueY, valueR)
    }

}

function addElement(data) {
    const table = document.getElementById('table');
    table.innerHTML += data;
}