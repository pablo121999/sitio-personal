let speed = 0;
let altitude = 0;
let direction = 0;
let score = 0;

let planePosition = {
    x: 10,
    y: 50
};

const plane = document.getElementById('plane');
const contenerPlane = document.getElementById('contenerplane');
const speedDisplay = document.getElementById('speed');
const altitudeDisplay = document.getElementById('altitude');
const directionDisplay = document.getElementById('direction');

// Mostrar puntaje
const scoreDisplay = document.createElement('div');
scoreDisplay.id = 'scoreDisplay';
scoreDisplay.textContent = `Puntaje: ${score}`;
document.getElementById('hud').appendChild(scoreDisplay);

document.addEventListener('DOMContentLoaded', () => {
    updatePlanePosition();
});

document.addEventListener('keydown', (e) => {

    if (isPaused) return;

    if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', ' '].includes(e.key)) {
        e.preventDefault();
    }

    const audioPlayer = document.getElementById('audioPlayer');
    if (audioPlayer.paused) {
        audioPlayer.play().catch(error => console.error("Audio error:", error));
    }

    const containerRect = contenerPlane.getBoundingClientRect();
    const planeRect = plane.getBoundingClientRect();
    const maxLeft = (containerRect.width - planeRect.width) / containerRect.width * 100;
    const maxBottom = (containerRect.height - planeRect.height) / containerRect.height * 100;

    switch (e.key) {
        case 'ArrowUp':
            altitude += 10;
            planePosition.y = Math.min(planePosition.y + 5, maxBottom);
            break;
        case 'ArrowDown':
            altitude = Math.max(altitude - 10, 0);
            planePosition.y = Math.max(planePosition.y - 5, 0);
            break;
        case 'ArrowLeft':
            direction = (direction - 10 + 360) % 360;
            planePosition.x = Math.max(planePosition.x - 5, 0);
            break;
        case 'ArrowRight':
            direction = (direction + 10) % 360;
            planePosition.x = Math.min(planePosition.x + 5, maxLeft);
            break;
        case ' ':
            speed = Math.min(speed + 10, 200);
            break;
    }

    updateHUD();
    updatePlanePosition();
});

function updateHUD() {
    speedDisplay.textContent = speed;
    altitudeDisplay.textContent = altitude;
    directionDisplay.textContent = direction;
}

function updatePlanePosition() {
    plane.style.left = `${planePosition.x}%`;
    plane.style.bottom = `${planePosition.y}%`;
}

// Generar obstáculos cada 2 segundos
setInterval(() => {
    if (!crashed) createObstacle();
}, 3000);


// Crear obstáculos con imagen y movimiento
function createObstacle() {
    if (isPaused) return;
    const obs = document.createElement('img');
    obs.src = imagen;
    obs.classList.add('obstacle');
    obs.style.left = '100%';
    obs.style.bottom = `${Math.random() * 80 + 10}%`;
    obs.style.height = '50px';
    obs.style.width = '20px';
    contenerPlane.appendChild(obs);

    const moveObstacle = () => {
        if (isPaused) return; // Pausar movimiento
        let left = parseFloat(obs.style.left);
        if (left <= -15) {
            clearInterval(interval);
            obs.remove();
            score += 10;
            scoreDisplay.textContent = `Puntaje: ${score}`;
        } else {
            obs.style.left = `${left - 1}%`;
            checkCollision();
        }
    };

    const interval = setInterval(moveObstacle, 50);
    obstacleIntervals.push(interval); // Guarda el intervalo
}


let crashed = false;

function checkCollision() {
    if (crashed) return; // Evita múltiples ejecuciones

    const planeRect = plane.getBoundingClientRect();
    const obstacles = document.querySelectorAll('.obstacle');

    obstacles.forEach(obstacle => {
        const obsRect = obstacle.getBoundingClientRect();
        const overlap = !(
            planeRect.right < obsRect.left ||
            planeRect.left > obsRect.right ||
            planeRect.bottom < obsRect.top ||
            planeRect.top > obsRect.bottom
        );

        if (overlap) {
            crashed = true;
            alert("💥 ¡Te estrellaste! Puntaje final: " + score);
            location.reload();
        }
    });
}


let isPaused = false;
let obstacleIntervals = []; // Para guardar los intervalos de movimiento

document.getElementById('pauseBtn').addEventListener('click', () => {
    isPaused = !isPaused;
    document.getElementById('pauseBtn').textContent = isPaused ? '▶️ Reanudar' : '⏸️ Pausar';

    if (isPaused) {
        pauseAllObstacles();
        document.getElementById('audioPlayer').pause();
    } else {
        document.getElementById('audioPlayer').play().catch(err => console.error(err));
         resumeAllObstacles(); // 👉 Reanudar obstáculos
    }
});



function pauseAllObstacles() {
    obstacleIntervals.forEach(i => clearInterval(i));
    obstacleIntervals = [];
}


function resumeAllObstacles() {
    const obstacles = document.querySelectorAll('.obstacle');
    obstacles.forEach(obstacle => {
        const moveObstacle = () => {
            if (isPaused) return;

            let left = parseFloat(obstacle.style.left);
            if (left <= -15) {
                clearInterval(interval);
                obstacle.remove();
                score += 10;
                scoreDisplay.textContent = `Puntaje: ${score}`;
            } else {
                obstacle.style.left = `${left - 1}%`;
                checkCollision();
            }
        };

        const interval = setInterval(moveObstacle, 50);
        obstacleIntervals.push(interval);
    });
}
