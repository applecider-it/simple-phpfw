/**
 * ツイート画面のセットアップ
 */

import { createApp } from 'vue';
import TweetArea from './vue/TweetArea.vue';

import TweetClient from './TweetClient';

const el = document.getElementById('tweet-root');

if (el) {
  const tweetClient = new TweetClient();

  createApp(TweetArea, {
    tweetClient: tweetClient,
  }).mount(el);
}
