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
  private room: string;

  constructor(urls: Urls, room: string) {
    this.urls = urls;
    this.room = room;

    const channelId = `simplephpfw-chat-channel--${this.room}`;

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
    const data = { message, room: this.room };
    console.log("url", url, data);

    const result = await sendData<{ newId: number }>(method, url, data);

    console.log("result", result);
  }
}
