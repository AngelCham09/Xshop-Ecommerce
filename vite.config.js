import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        outDir: "public/build",
        emptyOutDir: true,
    },
    // server: {
    //     host: "0.0.0.0",
    //     hmr: {
    //         host: "localhost",
    //     },
    // },
});
