export class Particle {
    constructor(ctx, particleImage, canvasWidth, canvasHeight) {
        this.ctx = ctx;
        this.particleImage = particleImage;
        this.canvasWidth = canvasWidth;
        this.canvasHeight = canvasHeight;
        this.x = Math.random() * this.canvasWidth;
        this.y = Math.random() * this.canvasHeight;
        this.vx = Math.random() * 4 - 2;
        this.vy = Math.random() * 4 - 2;
        this.size = Math.random() * 20 + 10;
        this.connections = [];
        this.radius = 15;
        this.speedX = Math.random() * 4 - 2;
        this.speedY = Math.random() * 4 - 2;

    }

    distanceTo(otherParticle) {
        const dx = this.x - otherParticle.x;
        const dy = this.y - otherParticle.y;
        return Math.sqrt(dx * dx + dy * dy);
    }

    update() {
        this.x += this.speedX;
        this.y += this.speedY;

        if (this.x - this.radius < 0 || this.x + this.radius > window.innerWidth) {
            this.speedX = -this.speedX;
        }

        if (this.y - this.radius < 0 || this.y + this.radius > window.innerHeight) {
            this.speedY = -this.speedY;
        }
    }

    checkCollision(otherParticle) {
        let dx = this.x - otherParticle.x;
        let dy = this.y - otherParticle.y;
        let distance = Math.sqrt(dx * dx + dy * dy);
        let minDistance = this.radius + otherParticle.radius;

        if (distance < minDistance) {
            let angle = Math.atan2(dy, dx);
            let sin = Math.sin(angle);
            let cos = Math.cos(angle);

            let pos1 = { x: 0, y: 0 };
            let pos2 = { x: dx * cos + dy * sin, y: dy * cos - dx * sin };
            let vel1 = { x: this.speedX * cos + this.speedY * sin, y: this.speedY * cos - this.speedX * sin };
            let vel2 = { x: otherParticle.speedX * cos + otherParticle.speedY * sin, y: otherParticle.speedY * cos - otherParticle.speedX * sin };

            let vxTotal = vel1.x - vel2.x;
            vel1.x = ((this.radius - otherParticle.radius) * vel1.x + 2 * otherParticle.radius * vel2.x) / (this.radius + otherParticle.radius);
            vel2.x = vxTotal + vel1.x;

            pos1.x += vel1.x;
            pos2.x += vel2.x;

            let pos1F = { x: pos1.x * cos - pos1.y * sin, y: pos1.y * cos + pos1.x * sin };
            let pos2F = { x: pos2.x * cos - pos2.y * sin, y: pos2.y * cos + pos2.x * sin };

            otherParticle.x = this.x + pos2F.x - pos1F.x;
            otherParticle.y = this.y + pos2F.y - pos1F.y;

            this.speedX = vel1.x * cos - vel1.y * sin;
            this.speedY = vel1.y * cos + vel1.x * sin;
            otherParticle.speedX = vel2.x * cos - vel2.y * sin;
            otherParticle.speedY = vel2.y * cos + vel2.x * sin;
        }
    }

    draw(context, particleImage) {
        context.drawImage(
            particleImage,
            this.x - this.radius,
            this.y - this.radius,
            this.radius * 2,
            this.radius * 2
        );
    }
}
