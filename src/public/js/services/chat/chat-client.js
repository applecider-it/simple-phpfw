import { sendData } from "@/services/api/rest";

/**
 * チャットクライアント
 */
export default class ChatClient {
  constructor(host, token, room) {
    this.ws = null;

    this.host = host;
    this.token = token;
    this.room = room;

    this.ws = new WebSocket(`ws://${this.host}?token=${this.token}`);

    this.ws.onopen = () => console.log("🔗 Connected");
    this.ws.onclose = () => console.log("❌ Disconnected");

    this.ws.onmessage = (e) => this.#handleMessage(e);

    this.addMessage = null;
  }

  /**
   * 受信処理
   */
  #handleMessage(e) {
    let data;
    try {
      data = JSON.parse(e.data);
    } catch {
      console.warn("Wrong JSON:", e.data);
      return;
    }

    console.log("handleMessage", data);

    let row;

    if (data.sender.id === 0) {
      // Redis経由でWebSocketが送信されたとき

      row = {
        message: data.data.message,
        name: data.data.name,
      };
    } else {
      // WebSocketから直接送信されたとき

      row = {
        message: data.data.message,
        name: data.sender.name,
      };
    }

    this.addMessage(row);
  }

  /**
   * メッセージ送信
   */
  async send(message, type) {
    if (!message) return;

    if (type === "redis") {
      const method = "POST";
      const data = { message, room: this.room };

      const url = "/chat/store_redis";

      const result = await sendData(method, url, data);

      console.log("result", result);
    } else {
      this.ws.send(JSON.stringify({ data: { message } }));
    }
  }
}
