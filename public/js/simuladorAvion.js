let speed = 0;
let altitude = 0;
let direction = 0;

let planePosition = {
    x: 10, // Horizontal (10% = inicial)
    y: 50 // Vertical (50% = centro)
};

const plane = document.getElementById('plane');
const contenerPlane = document.getElementById('contenerplane');
const speedDisplay = document.getElementById('speed');
const altitudeDisplay = document.getElementById('altitude');
const directionDisplay = document.getElementById('direction');

document.addEventListener('DOMContentLoaded', () => {
    updatePlanePosition(); // Aplica la posición inicial
});

document.addEventListener('keydown', (e) => {
    // Previene el comportamiento predeterminado de las flechas
    if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', ' '].includes(e.key)) {
        e.preventDefault();
    }

    const audioPlayer = document.getElementById('audioPlayer');

    // Reproducir el audio si no está reproduciéndose
    if (audioPlayer.paused) {
        audioPlayer.play().catch(error => {
            console.error("Error al reproducir el audio:", error);
        });
    }

    // Obtén las dimensiones del contenedor y del avión
    const containerRect = contenerPlane.getBoundingClientRect();
    const planeRect = plane.getBoundingClientRect();

    // Calcula los límites en porcentaje
    const maxLeft = (containerRect.width - planeRect.width) / containerRect.width * 100;
    const maxBottom = (containerRect.height - planeRect.height) / containerRect.height * 100;

    switch (e.key) {
        case 'ArrowUp':
            altitude += 10; // Incrementa la altitud
            planePosition.y = Math.min(planePosition.y + 5, maxBottom); // Limita el movimiento hacia arriba
            break;
        case 'ArrowDown':
            altitude = Math.max(altitude - 10, 0); // Disminuye la altitud
            planePosition.y = Math.max(planePosition.y - 5, 0); // Limita el movimiento hacia abajo
            break;
        case 'ArrowLeft':
            direction = (direction - 10 + 360) % 360; // Gira hacia la izquierda
            planePosition.x = Math.max(planePosition.x - 5, 0); // Limita el movimiento hacia la izquierda
            break;
        case 'ArrowRight':
            direction = (direction + 10) % 360; // Gira hacia la derecha
            planePosition.x = Math.min(planePosition.x + 5, maxLeft); // Limita el movimiento hacia la derecha
            break;
        case ' ':
            speed = Math.min(speed + 10, 200); // Incrementa la velocidad
            break;
    }

    updateHUD(); // Actualiza los datos del HUD
    updatePlanePosition(); // Actualiza la posición visual del avión
});

function updateHUD() {
    speedDisplay.textContent = speed;
    altitudeDisplay.textContent = altitude;
    directionDisplay.textContent = direction;
}

function updatePlanePosition() {
    // Actualiza la posición visual del avión dentro del contenedor
    plane.style.left = `${planePosition.x}%`;
    plane.style.bottom = `${planePosition.y}%`;
}
