import { clone } from "@/services/data/json";

/**
 * REST関連
 */

/** getパラメーター生成 */
export function toQueryString(params) {
  return new URLSearchParams(params).toString();
}

/** Jsonデータを送受信 */
export async function sendData(method, url, argData = {}) {
  const data = clone(argData);

  const params = {
    method: method,
    headers: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  };

  if (method !== "GET") {
    const token = csrfToken();

    params.body = JSON.stringify(data);
    params.headers["X-CSRF-TOKEN"] = token;
  }

  const res = await fetch(url, params);

  // JSONとして受け取る
  const result = await res.json();

  return result;
}

/** CSRFトークンをmetaタグから取得 */
function csrfToken() {
  return document.querySelector('meta[name="csrf-token"]').content;
}