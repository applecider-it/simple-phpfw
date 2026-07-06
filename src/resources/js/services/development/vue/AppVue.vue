<script setup lang="ts">
import JsonTest from './app-vue/JsonTest.vue';

const props = defineProps<{
  valueTest: any;
}>();

</script>

<template>
  <div class="space-y-4">
    <div>
      <JsonTest />
    </div>

    <div>
      <h3 class="app-h3">コントローラー連動動作確認</h3>
      <div class="space-x-2 mt-3">
        <div>valueTest.value1: {{ valueTest.value1 }}</div>
      </div>
    </div>
  </div>
</template>
