import { defineConfig } from "vite";
import path from "path";
import vue from "@vitejs/plugin-vue";
import fullReload from "vite-plugin-full-reload";

export default defineConfig({
    plugins: [fullReload(["resources/views/**/*.html.php"]), vue()],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
        },
    },
    build: {
        outDir: "public/build",
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: [
                "resources/js/entrypoints/app.ts",
                "resources/js/entrypoints/tweet.ts",
                "resources/js/entrypoints/chat.ts",
                "resources/js/entrypoints/admin/app.ts",
                "resources/js/entrypoints/development/javascript-test.ts",

                "resources/css/app.css",
                "resources/css/admin.css",
            ],
        },
    },
    server: {
        watch: {
            usePolling: true,
            interval: 2000,
        },
    },
});
