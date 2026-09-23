import "./bootstrap/alpinejs";
import "./bootstrap/swiper";

console.log("app start");

// 動作確認
import { getMetaJson } from "@/services/data/html";

console.log("auth user", getMetaJson("user"));
