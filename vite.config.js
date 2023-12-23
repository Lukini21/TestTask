import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import vue from '@vitejs/plugin-vue'


export default defineConfig({
    plugins: [

        vue(),

        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/vendor/bootstrap/bootstrap.min.js',
                'resources/js/vendor/jquery/jquery.js',
                'resources/js/vendor/jquery/jquery.slim.js'
            ],
            refresh: true,
        }),
    ],
});
