import { defineConfig } from 'vite';
import { resolve, dirname } from 'path';
import { fileURLToPath } from 'url';
import autoprefixer from 'autoprefixer';

const __dirname = dirname(fileURLToPath(import.meta.url));
const JS_FILE = resolve(__dirname, 'src/scripts/main.js');
const BUILD_DIR = resolve(__dirname, 'dist');

export default defineConfig({
  build: {
    assetsDir: '',
    manifest: true,
    emptyOutDir: true,
    outDir: BUILD_DIR,
    rollupOptions: {
      input: JS_FILE,
    },
  },
  css: {
    devSourcemap: true,
    postcss: {
      plugins: [autoprefixer()],
    },
  },
});