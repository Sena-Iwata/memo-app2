<template>
  <textarea :value="modelValue"
            @keydown.enter.prevent="handleEnter"
            @input="emit('update:modelValue', ($event.target as HTMLTextAreaElement).value)"
      class="w-full h-28 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none transition duration-200 placeholder:text-gray-40 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
      placeholder="メモを入力してください...&#10;(Enterで保存、Shift+Enterで改行)"
  ></textarea>
</template>
<script setup lang="ts">
import { nextTick } from 'vue';
const props = defineProps<{
    modelValue: string
}>();
const emit = defineEmits<{
    (e: 'update:modelValue', value: string): void
    (e: 'submit'): void // 'submit'イベントを新しく定義
}>();
const handleEnter=(event:KeyboardEvent)=>{
    if(event.shiftKey){
        const target=event.target as HTMLTextAreaElement;
        const start=target.selectionStart;
        const end=target.selectionEnd;
        const newValue=props.modelValue.substring(0,start)+'\n'+props.modelValue.substring(end);
        emit('update:modelValue', newValue);
        nextTick(() => {
            target.selectionStart = target.selectionEnd = start + 1;
        });

    } else {
        emit('submit');
    }


};

</script>
