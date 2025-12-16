import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  base: '/aca-ganaderia-backend/public/build/',
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/admin.js',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
});
