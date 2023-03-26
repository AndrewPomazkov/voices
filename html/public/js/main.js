import { ParticleSystem } from './ParticleSystem.js';

const particleImage = new Image();
particleImage.src = '/images/avatar-svgrepo-com.png';
particleImage.onerror = function() {
    console.error('Error loading the particle image');
};
particleImage.onabort = function() {
    console.error('Loading of the particle image was aborted');
};

const canvas = document.getElementById('particleCanvas');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Создание экземпляра системы частиц
const particleSystem = new ParticleSystem(canvas, particleImage, 50);

let mouseX = 0;
let mouseY = 0;

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    particleSystem.updateCanvasSize(canvas.width, canvas.height);
}

function animate() {
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
    // Получаем размеры окна
    const windowWidth = window.innerWidth;
    const windowHeight = window.innerHeight;

    // Генерируем случайные координаты в рамках размеров окна
    const randomX = Math.floor(Math.random() * windowWidth);
    const randomY = Math.floor(Math.random() * windowHeight);

    // Обновление и отрисовка частиц
    particleSystem.updateParticles(randomX, randomY);
    particleSystem.createConnections();
    particleSystem.drawParticles();

    requestAnimationFrame(animate);
}

function showParticleInfo(index, x, y) {
    // Создаем div с информацией о частице
    const particleInfoDiv = document.createElement('div');
    particleInfoDiv.style.position = 'absolute';
    particleInfoDiv.style.left = `${x - 75}px`;
    particleInfoDiv.style.top = `${y}px`;
    particleInfoDiv.style.width = '350px';
    particleInfoDiv.style.height = '180px';
    particleInfoDiv.style.backgroundColor = 'white';
    particleInfoDiv.style.borderRadius = '5px';
    particleInfoDiv.style.display = 'block';
    particleInfoDiv.style.border = '1px solid #000000';
    particleInfoDiv.style.alignItems = 'center';
    particleInfoDiv.style.justifyContent = 'center';
    particleInfoDiv.style.zIndex = 100000;
    particleInfoDiv.id = 'particle-info';
    // Удаляем предыдущий div с информацией о частице, если он существует
    const existingInfoDiv = document.getElementById('particle-info');
    if (existingInfoDiv) {
        existingInfoDiv.remove();
    }

    // Создаем отдельный элемент для аудиоплеера
    const audioPlayerDiv = document.createElement('div');
    audioPlayerDiv.id = 'audio-player';

    // Добавляем элемент в particleInfoDiv
    particleInfoDiv.appendChild(audioPlayerDiv);

    // Создаем экземпляр WaveSurfer и передаем ему новый элемент
    var wavesurfer = WaveSurfer.create({
        container: audioPlayerDiv,
        waveColor: 'violet',
        progressColor: 'purple'
    });

    // Загружаем аудио файл
    wavesurfer.load('/storage/audio/1679248460.wav');

    // Добавляем particleInfoDiv на страницу
    document.body.appendChild(particleInfoDiv);
}

// Запуск анимации после загрузки изображения
particleImage.onload = function () {
    resizeCanvas();
    animate();

};
canvas.addEventListener('mousemove', (event) => {
    mouseX = event.clientX;
    mouseY = event.clientY;
});
canvas.addEventListener('click', (event) => {
    const clickedX = event.clientX;
    const clickedY = event.clientY;
    const clickedParticleIndex = particleSystem.getClickedParticle(clickedX, clickedY);
    console.log('clicked');
    if (clickedParticleIndex !== null) {
        showParticleInfo(clickedParticleIndex, clickedX, clickedY);
    }
});
canvas.addEventListener('mousemove', (event) => {
    mouseX = event.clientX;
    mouseY = event.clientY;
});
canvas.addEventListener('click', (event) => {
    const clickedX = event.clientX;
    const clickedY = event.clientY;
    const clickedParticleIndex = particleSystem.getClickedParticle(clickedX, clickedY);
    console.log('clicked');
    if (clickedParticleIndex !== null) {
        showParticleInfo(clickedParticleIndex, clickedX, clickedY);
    }
});
window.addEventListener('resize', resizeCanvas);
