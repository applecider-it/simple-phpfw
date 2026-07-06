import { sendData } from "@/services/api/rest";

type Urls = {
  list: string;
  store: string;
}

/**
 * ツイートクライアント
 */
export default class TweetClient {
  /** 一覧を最新の状態にする */
  public refreshList: Function;

  private urls: Urls;

  constructor(urls: Urls) {
    this.urls = urls;
  }

  /**
   * 新しいツイート送信
   */
  async sendTweet(content) {
    const method = "POST";

    const url = this.urls.store;
    const data = { content };
    console.log("url", url, data);

    const result = await sendData<any>(method, url, data);

    console.log("result", result);
  }

  /** 一覧取得 */
  async getList() {
    const method = "GET";

    const url = this.urls.list;
    const data = {};
    console.log("url", url, data);

    const result = await sendData<any>(method, url, data);

    console.log("result", result);
    console.log("result.tweets", result.tweets);

    return result.tweets;
  }
}
