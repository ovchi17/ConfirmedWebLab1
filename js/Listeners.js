document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.button');

    buttons.forEach(button => {
        button.addEventListener('click', (event) => {

            buttons.forEach(otherButton => {
                otherButton.classList.remove('active');
            });

            button.classList.add('active');
        });
    });
});