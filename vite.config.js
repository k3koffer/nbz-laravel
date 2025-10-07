import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/blog.js'
            ],
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
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '@': path.resolve(__dirname, 'resources/js'),
            'vue': path.resolve(__dirname, 'node_modules/vue/dist/vue.esm-bundler.js'),
        },
        dedupe: ['vue'],
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `
                    @import "~bootstrap/scss/functions";
                    @import "~bootstrap/scss/variables";
                    @import "~bootstrap/scss/mixins";
                `,
                silenceDeprecations: [
                    'import', 
                    'global-builtin', 
                    'color-functions'
                ],
                quietDeps: true,
            }
        }
    },
    build: {
        chunkSizeWarningLimit: 1500,
    }
});
