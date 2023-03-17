export class Particle {
    constructor(
            ctx,
            particleImage,
            canvasWidth,
            canvasHeight,


            user_name,
            item_path,
            item_filename,
            item_created_at,
            item_updated_at,
            item_id,
            item_user_id
    ) {
        this.ctx = ctx;
        this.postImage = this.particleImage = particleImage;

        this.user_name = user_name;
        this.audioUri = this.item_path=item_path;
        this.item_filename=item_filename;
        this.item_created_at=item_created_at;
        this.item_updated_at=item_updated_at;
        this.item_id=item_id;
        this.userId = this.item_user_id=item_user_id;

        this.canvasWidth = canvasWidth;
        this.canvasHeight = canvasHeight;
        this.x = Math.random() * this.canvasWidth;
        this.y = Math.random() * this.canvasHeight;
        this.vx = Math.random() * 4 - 2;
        this.vy = Math.random() * 4 - 2;
        this.connections = [];
        this.radius = 25;
        this.speedX =Math.random() * (0.50 - 0.15) + 0.15;
        this.speedY = Math.random() * (0.50 - 0.15) + 0.15;
        this.z = Math.random() * this.canvasWidth;
        this.zSpeed = Math.random() * 0.9 - 0.45;
        this.scaledSize = this.size * (1 - this.z / this.canvasWidth);
        this.alpha = 1 - this.z / this.canvasWidth;
        this.zFactor = 1 - this.z / this.canvasWidth;

        const minSize = 20; // Задайте желаемый минимальный размер
        const maxSize = 60; // Задайте желаемый максимальный размер
        this.size = Math.random() * (maxSize - minSize) + minSize;
        this.alpha = (((maxSize - this.size) / (maxSize - minSize)) * 0.50) + 0.25;
        this.lastMouseX = null;
        this.lastMouseY = null;
        this.lastMouseMoveTime = null

        this.addBorder = false;
    }

    distanceTo(otherParticle) {
        const dx = this.x - otherParticle.x;
        const dy = this.y - otherParticle.y;
        return Math.sqrt(dx * dx + dy * dy);
    }

    setBorder() {
        this.addBorder = true;
        return this;
    }

    update(mouseX, mouseY) {
        const currentTime = Date.now();

        if (mouseX !== this.lastMouseX || mouseY !== this.lastMouseY) {
            this.lastMouseMoveTime = currentTime;
        }

        this.lastMouseX = mouseX;
        this.lastMouseY = mouseY;

        const isCursorStopped = currentTime - this.lastMouseMoveTime > 100; // 100ms - время задержки перед считыванием остановки курсора

        const distanceToMouse = Math.sqrt(Math.pow(this.x - mouseX, 2) + Math.pow(this.y - mouseY, 2));

        if (isCursorStopped && distanceToMouse < 200) {
            const attractionStrength = 0.02; // Значение, определяющее силу притяжения частицы к курсору

            this.vx += (mouseX - this.x) * attractionStrength;
            this.vy += (mouseY - this.y) * attractionStrength;
        }
        if (distanceToMouse < 200 && this.alpha > 0.4) {
            return;
        }
        const zAdjustedSpeedX = this.speedX * (1 - this.z * this.zFactor / this.canvasWidth);
        const zAdjustedSpeedY = this.speedY * (1 - this.z * this.zFactor / this.canvasWidth);

        this.x += zAdjustedSpeedX;
        this.y += zAdjustedSpeedY;
        this.z = (this.z + this.zSpeed + this.canvasWidth) % this.canvasWidth;

        this.x += this.speedX;
        this.y += this.speedY;
        this.z = (this.z + this.zSpeed + this.canvasWidth) % this.canvasWidth;

        if (this.z < 0 || this.z > this.canvasWidth) {
            this.zSpeed = -this.zSpeed;
        }

        if (this.x - this.radius < 0 || this.x + this.radius > window.innerWidth) {
            this.speedX = -this.speedX;
        }

        if (this.y - this.radius < 0 || this.y + this.radius > window.innerHeight) {
            this.speedY = -this.speedY;
        }

        this.scaledSize = this.size * (1 - this.z / this.canvasWidth);
        this.alpha = 1 - this.z / this.canvasWidth;

        this.scaledSize = this.size * (1 - this.z / this.canvasWidth);
        this.alpha = Math.max(0.25, 1 - this.z / this.canvasWidth);


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
        const scaleFactor = this.z / this.canvasWidth;
        const scaledSize = this.size * scaleFactor;

        context.save();
        context.globalAlpha = this.alpha;

        // Создаем круглый клип-путь
        context.beginPath();
        context.arc(this.x, this.y, scaledSize / 2, 0, 2 * Math.PI, false);
        context.closePath();
        context.clip();

        if (this.addBorder) {
            this.ctx.strokeStyle = 'black'; // Цвет рамки (можете изменить на другой)
            this.ctx.lineWidth = 1; // Толщина рамки (можете изменить на другое значение)
            this.ctx.stroke();
        }

        // Рисуем изображение внутри круглого клип-пути
        context.drawImage(
            particleImage,
            this.x - scaledSize / 2,
            this.y - scaledSize / 2,
            scaledSize,
            scaledSize
        );

        context.restore();
    }

}
