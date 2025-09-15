<template>
    <button
        @click="$emit('save')"
        :disabled="isDisabled"
        :class="{
        'bg-gray-300 cursor-not-allowed': isDisabled,
        'bg-gradient-to-r from-orange-300 to-pink-400 hover:opacity-95': !isDisabled
        }"
        class="w-full mt-4 flex items-center justify-center px-6 py-3 text-white font-bold rounded-lg transition-all duration-200"
    >
        <PlusSvg/>
        <span>メモを保存</span>
    </button>
</template>
<script setup lang="ts">
import { ref } from 'vue';
import PlusSvg from "@/components/svgs/PlusSvg.vue";
const memoText = ref('');

defineProps<{
    isDisabled: boolean
}>();
defineEmits<{(e: 'save'): void}>();
</script>
