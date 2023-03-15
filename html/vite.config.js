import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.blade.php.css', 'resources/js/app.blade.php.js'],
            refresh: true,
        }),
    ],
});
