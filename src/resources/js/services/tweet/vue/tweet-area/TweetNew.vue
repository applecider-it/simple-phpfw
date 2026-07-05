<script setup lang="ts">
import { ref, onMounted } from "vue";
import type TweetClient from "../../TweetClient";

type Errors = {
  content?: string[];
};

const props = defineProps<{
  tweetClient: TweetClient;
}>();

const content = ref<string>("");
const errors = ref<Errors>({});

onMounted(() => {
  console.log("init new");
});

/** 送信 */
const onSubmit = async () => {
  try {
    await props.tweetClient.sendTweet(content.value);

    errors.value = {};

    props.tweetClient.refreshList();

    content.value = "";
  } catch (error: any) {
    if (error.response?.status === 422) {
      errors.value = error.response.data.errors;
    }
  }
};
</script>

<template>
  <div>
    <h3 class="app-h3">新規ツイート</h3>

    <form @submit.prevent="onSubmit" class="mb-4 mt-3">
      <textarea
        rows="3"
        class="app-form-input"
        placeholder="What's happening?"
        name="content"
        v-model="content"
      />

      <p v-if="errors?.content" class="app-form-error">
        {{ errors.content[0] }}
      </p>

      <button type="submit" class="mt-2 app-btn-primary">確認</button>
    </form>
  </div>
</template>
