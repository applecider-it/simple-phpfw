import { ChatMessage } from "./types";

import { pusher } from "@/services/app/pusher";
import { sendData } from "@/services/api/rest";

type Urls = {
  store: string;
};

/**
 * チャットクライアント
 */
export default class ChatClient {
  addMessage: Function;

  private urls: Urls;

  constructor(urls: Urls) {
    this.urls = urls;

    const channelId = "simplephpfw-chat-channel";

    // pusher 接続
    const channel = pusher.subscribe(channelId);

    channel.bind("new-message", (data) => this.onMessageP(data));
  }

  /** Pusherメッセージ受信 */
  private onMessageP(data) {
    console.log("受信:", data);
    this.addMessage({
      message: data.message,
      userId: data.user_id,
      name: data.name,
    } as ChatMessage);
  }

  /** メッセージ送信 */
  async sendMessage(message: string) {
    console.log("sendMessage", message);

    const method = "POST";

    const url = this.urls.store;
    const data = { message };
    console.log("url", url, data);

    const result = await sendData<{ newId: number }>(method, url, data);

    console.log("result", result);
  }
}
