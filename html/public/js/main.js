import { ParticleSystem } from './ParticleSystem.js';

// Загрузка изображения
const particleImage = new Image();
particleImage.src = '/images/avatar-svgrepo-com.png';

particleImage.onerror = function() {
    console.error('Error loading the particle image');
};

particleImage.onabort = function() {
    console.error('Loading of the particle image was aborted');
};

// Получение элемента холста и установка размеров
const canvas = document.getElementById('particleCanvas');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Создание экземпляра системы частиц
const particleSystem = new ParticleSystem(canvas, particleImage, 0);

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    particleSystem.updateCanvasSize(canvas.width, canvas.height);
}
window.addEventListener('resize', resizeCanvas);
let mouseX = 0;
let mouseY = 0;

canvas.addEventListener('mousemove', (event) => {
    mouseX = event.clientX;
    mouseY = event.clientY;
});

canvas.addEventListener('click', (event) => {
    const clickedX = event.clientX;
    const clickedY = event.clientY;
    const clickedParticleIndex = particleSystem.getClickedParticle(clickedX, clickedY);
    if (clickedParticleIndex !== null) {
        showParticleInfo(clickedParticleIndex, clickedX, clickedY);
    }
});

// Функция анимации
function animate() {
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

    // Обновление и отрисовка частиц
    particleSystem.updateParticles(mouseX, mouseY);
    particleSystem.createConnections();
    particleSystem.drawParticles();

    requestAnimationFrame(animate);
}

function showParticleInfo(index, x, y) {
    const particleInfoDiv = document.createElement('div');
    particleInfoDiv.style.position = 'absolute';
    particleInfoDiv.style.left = `${x - 75}px`; // Смещение div на половину его ширины
    particleInfoDiv.style.top = `${y}px`; // Расположение div немного ниже частицы
    particleInfoDiv.style.width = '150px';
    particleInfoDiv.style.height = '80px';
    particleInfoDiv.style.backgroundColor = 'white';
    particleInfoDiv.style.borderRadius = '5px';
    particleInfoDiv.style.display = 'flex';
    particleInfoDiv.style.alignItems = 'center';
    particleInfoDiv.style.justifyContent = 'center';
    particleInfoDiv.style.zIndex = 1000; // Устанавливаем высокий zIndex, чтобы div отображался поверх всех элементов
    particleInfoDiv.innerHTML = `Index: ${index}`;

    // Удаляем предыдущий div с информацией о частице, если он существует
    const existingInfoDiv = document.getElementById('particle-info');
    if (existingInfoDiv) {
        existingInfoDiv.remove();
    }

    // Добавляем id и добавляем div на страницу
    particleInfoDiv.id = 'particle-info';
    document.body.appendChild(particleInfoDiv);
}

// Запуск анимации после загрузки изображения
particleImage.onload = function () {
    resizeCanvas();
    animate();

};
