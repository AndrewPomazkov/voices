import { ParticleSystem } from './ParticleSystem.js';

// Загрузка изображения
const particleImage = new Image();
particleImage.src = '/images/avatar-svgrepo-com.png';

// Получение элемента холста и установка размеров
const canvas = document.getElementById('particleCanvas');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Создание экземпляра системы частиц
const particleSystem = new ParticleSystem(canvas, particleImage, 100);

// Функция анимации
function animate() {
    // Очистка холста
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

    // Обновление и отрисовка частиц
    particleSystem.updateParticles();
    particleSystem.drawParticles();

    requestAnimationFrame(animate);
}

// Запуск анимации после загрузки изображения
particleImage.onload = function () {
    animate();
};
