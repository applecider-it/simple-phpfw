import { sendData } from "@/services/api/rest";

/**
 * ツイートクライアント
 */
export default class TweetClient {
  /** 一覧を最新の状態にする */
  public refreshList: Function;

  /**
   * 新しいツイート送信
   */
  async sendTweet(content) {
    const method = "POST";

    const url = "/tweets-js/store";
    const data = { content };
    console.log("url", url, data);

    const result = await sendData<any>(method, url, data);

    console.log("result", result);
  }

  /** 一覧取得 */
  async getList() {
    const method = "GET";

    const url = "/tweets-js/list";
    const data = {};
    console.log("url", url, data);

    const result = await sendData<any>(method, url, data);

    console.log("result", result);
    console.log("result.tweets", result.tweets);

    return result.tweets;
  }
}
