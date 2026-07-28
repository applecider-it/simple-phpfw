<script setup lang="ts">
import { ref, computed, onMounted } from "vue";

import { ChatMessage } from "../types";
import type ChatClient from "../ChatClient";

const props = defineProps<{
  chatClient: ChatClient;
}>();

type Errors = {
  message?: string[];
};

const message = ref<string>("");
const messages = ref<ChatMessage[]>([]);
const errors = ref<Errors>({});

/** 逆順メッセージ */
const reversedMessages = computed<ChatMessage[]>(() => {
  return [...messages.value].reverse();
});

/** Enterキー */
const onKeydown = (e: KeyboardEvent): void => {
  if (e.key === "Enter") sendMessage();
};

/** メッセージ送信 */
const sendMessage = async () => {
  try {
    await props.chatClient.sendMessage(message.value.trim());

    errors.value = {};

    message.value = "";
  } catch (error: any) {
    if (error.response?.status === 422) {
      errors.value = error.response.data.errors;
    }
  }
};

/** 初期化 */
onMounted(() => {
  props.chatClient.addMessage = (val: ChatMessage) => {
    messages.value.push(val);
  };
});
</script>

<template>
  <div>
    <div>
      <input
        type="text"
        class="app-form-input"
        style="max-width: 30rem"
        v-model="message"
        placeholder="Message"
        @keydown="onKeydown"
      />

      <button @click="sendMessage()" class="app-btn-primary w-auto ml-2 mt-2">
        Send
      </button>
    </div>

    <div v-if="errors?.message" class="app-form-error">
      {{ errors.message[0] }}
    </div>

    <div class="h-72 my-5 overflow-y-scroll border-2">
      <ul>
        <li v-for="(msg, index) in reversedMessages" :key="index" class="p-1">
          {{ msg.message }}
          <span class="ml-3 text-sm text-gray-500">
            by {{ msg.name }} ({{ msg.userId }})
          </span>
        </li>
      </ul>
    </div>
  </div>
</template>
