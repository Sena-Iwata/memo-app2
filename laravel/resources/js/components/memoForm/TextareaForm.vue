<template>
  <textarea :class="Buttons.memoText"
            @input="$emit('update:modelValue', ($event.target as HTMLTextAreaElement).value)"
      class="w-full h-28 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none transition duration-200 placeholder:text-gray-400"
      placeholder="メモを入力してください...&#10;(Enterで保存、Shift+Enterで改行)"
  ></textarea>
</template>
<script setup lang="ts">
import Buttons from "@/components/memoForm/Buttons.vue";

defineProps<{
    modelValue: string
}>();

// 親にデータを通知(emit)するための定義
defineEmits<{
    (e: 'update:modelValue', value: string): void
}>();
</script>
