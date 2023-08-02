import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import Vuetify from '@vuetify/vite-plugin';


export default defineConfig({
    plugins: [
        [vue(), Vuetify()],
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
