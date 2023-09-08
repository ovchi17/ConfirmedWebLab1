function careInput(event) {
    const targetInput = event.target;
    const validInputValue = targetInput.value.replace(/[^\d.-]/g, '');
    targetInput.value = validInputValue;
}

function checkInput(){
    let errorShow = document.querySelector('.checkInput');
    const buttons = document.querySelectorAll('.button');
    let valueY = document.getElementById("y-value").value;
    var result = '';
    var verdict = false;
    let isActiveButton = false;
    errorShow.classList.remove("show");

    buttons.forEach(button => {
        if (button.classList.contains('active')) {
            isActiveButton = true;
        }
    });
    if(isActiveButton){
        console.log("Кнопка ворк");
        if(!(valueY.trim() === "")){
            console.log("Поля не пустые");
            if (isNumber(valueY)){
                console.log("Числа - числа");
                if ((parseFloat(valueY) > -5) && (parseFloat(valueY) < 5)){
                    console.log("рейндж норм");
                    verdict = true;
                }else{
                    result = 'The values entered in the fields do not fall within the allowed range';
                }
            }else{
                result = 'The values entered in the fields are not numbers';
            }
        }else{
            result = 'Input fields cannot be empty';
        }
    }else{
        result = 'Please, choose X value';
    }
    errorShow.innerHTML = result;
    errorShow.classList.add("show");

    return verdict;
}

function isNumber(value) {
    return typeof value === 'string' && /^[-+]?\d+(\.\d+)?$/.test(value);
}