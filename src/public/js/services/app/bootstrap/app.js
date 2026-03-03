import { createApp } from "@/outer/vue3";

import AppCommon from "@/services/app/vue/app-common";
import { getAuthUser } from "@/services/app/application";

/** 共通コンテナをセットアップする */
function setupContainerCommon() {
  const el = document.getElementById("app-container-common");
  if (el) {
    createApp(AppCommon).mount(el);
  }
}

setupContainerCommon();

console.log("getAuthUser", getAuthUser());
