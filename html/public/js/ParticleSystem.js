import { Particle } from './Particle.js';

export class ParticleSystem {
    constructor(canvasElement, particleImage, particleCount = 100) {
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext('2d');
        if (!this.ctx) {
            console.error('Error getting canvas 2D context');
            return;
        }
        this.particleImage = particleImage;
        this.particleCount = particleCount;
        this.particles = [];

        for (let i = 0; i < this.particleCount; i++) {
            const particle = new Particle(this.ctx, this.particleImage, this.canvas.width, this.canvas.height);
            this.particles.push(particle);
        }
    }

    update() {
        this.particles.forEach((particle) => {
            particle.update();
        });

        // Проверка столкновений между частицами и обработка их
        for (let i = 0; i < this.particles.length - 1; i++) {
            for (let j = i + 1; j < this.particles.length; j++) {
                this.particles[i].checkCollision(this.particles[j]);
            }
        }
    }

    createConnections() {
        const maxDistance = 150;
        const ctx = this.ctx;
        ctx.strokeStyle = 'rgba(0, 0, 0, 0.5)';

        for (let i = 0; i < this.particles.length; i++) {
            for (let j = i + 1; j < this.particles.length; j++) {
                const particle1 = this.particles[i];
                const particle2 = this.particles[j];
                const distance = particle1.distanceTo(particle2);

                if (distance <= maxDistance) {
                    ctx.beginPath();
                    ctx.moveTo(particle1.x, particle1.y);
                    ctx.lineTo(particle2.x, particle2.y);
                    ctx.closePath();
                    ctx.lineWidth = 1 - distance / maxDistance;
                    ctx.stroke();
                }
            }
        }
    }

    updateParticles() {
        for (let particle of this.particles) {
            particle.update();
        }
    }

    checkCollisions() {
        for (let i = 0; i < this.particles.length - 1; i++) {
            for (let j = i + 1; j < this.particles.length; j++) {
                this.particles[i].checkCollision(this.particles[j]);
            }
        }
    }

    drawParticles() {
        for (let particle of this.particles) {
            particle.draw(this.ctx, this.particleImage);
        }
    }

    drawConnections() {
        this.canvasContext.beginPath();
        this.canvasContext.strokeStyle = "rgba(194,18,18,0.85)";

        for (let connection of this.connections) {
            this.canvasContext.moveTo(connection.source.x, connection.source.y);
            this.canvasContext.lineTo(connection.target.x, connection.target.y);
        }

        this.canvasContext.stroke();
    }

    animationLoop() {
        this.canvasContext.clearRect(0, 0, this.canvasElement.width, this.canvasElement.height);

        this.updateParticles();
        this.checkCollisions();
        this.drawConnections();
        this.drawParticles();

        requestAnimationFrame(() => this.animationLoop());
    }

    updateCanvasSize(width, height) {
        this.canvas.width = width;
        this.canvas.height = height;
    }
}
