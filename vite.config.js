import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                // Mengganti Instrument Sans ke Poppins
                bunny('Poppins', {
                    weights: [300, 400, 500, 600, 700],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        // host: '0.0.0.0', // <-- Tambahkan ini agar Vite membuka port ke jaringan lokal
        // hmr: {
        //     host: '192.168.79.31', // <-- IP laptop kamu
        // },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});