import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ], server: {
        https: false,
        host: true,
        strictPort: true,
        port: 5173,
        hmr: {host: 'localhost', protocol: 'ws'},
        watch: {
          usePolling:true,
        }
    },
    resolve: {
        alias:{
            '@': path.resolve(__dirname, 'resources/js/src'),
        }
    }
});
