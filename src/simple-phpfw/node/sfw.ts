import { Plugin } from "vite";
import fs from "fs";
import path from "path";

/**
 * SFW用Viteプラグイン
 * 
 * - Vite起動認識用のhotファイルの制御
 */
export function SFWVitePlugin(baseDir: string): Plugin {
  const hotFilePath = path.resolve(baseDir, "public/hot");

  return {
    name: "sfw-plugin",
    configureServer(server) {
      server.httpServer?.once("listening", () => {
        // 開始時

        // hotファイル作成
        fs.writeFileSync(hotFilePath, "");
      });

      const cleanUp = () => {
        // hotファイル削除
        if (fs.existsSync(hotFilePath)) {
          try {
            fs.rmSync(hotFilePath, { force: true });
          } catch (e) {
            // 無視
          }
        }
      };

      // Ctrl+C やプロセス終了時に hot ファイルを削除
      process.once("SIGINT", cleanUp);
      process.once("SIGTERM", cleanUp);
      process.once("exit", cleanUp);
    },
  };
}
