
document.addEventListener("DOMContentLoaded", function () {
    const brushButton = document.querySelector('.brush-icon');
    const colorPicker = document.querySelector('.color-picker');

    brushButton.addEventListener('click', (event) => {
        event.stopPropagation(); // Evita el cierre inmediato
        colorPicker.classList.toggle('active');
    });

    // Cierra la paleta si se hace clic fuera de ella
    document.addEventListener('click', (event) => {
        if (!colorPicker.contains(event.target) && event.target !== brushButton) {
            colorPicker.classList.remove('active');
        }
    });


    const tamanopincelButton = document.querySelector('#tamanopincel');
    const brushsizePicker = document.querySelector('#brush-size');

    tamanopincelButton.addEventListener('click', (event) => {
        event.stopPropagation(); // Evita que se cierre inmediatamente
        brushsizePicker.style.display = (brushsizePicker.style.display === 'block') ? 'none' :
            'block';
    });

    // Cierra el selector si se hace clic fuera de él
    document.addEventListener('click', (event) => {
        if (!brushsizePicker.contains(event.target) && event.target !== tamanopincelButton) {
            brushsizePicker.style.display = 'none';
        }
    });


    const tamanoBorradorButton = document.querySelector('#tamanoBorrador');
    const eraserPicker = document.querySelector('#eraser-size');

    tamanoBorradorButton.addEventListener('click', (event) => {
        event.stopPropagation(); // Evita que se cierre inmediatamente
        eraserPicker.style.display = (eraserPicker.style.display === 'block') ? 'none' :
            'block';
    });

    // Cierra el selector si se hace clic fuera de él
    document.addEventListener('click', (event) => {
        if (!eraserPicker.contains(event.target) && event.target !== tamanoBorradorButton) {
            eraserPicker.style.display = 'none';
        }
    });

});
