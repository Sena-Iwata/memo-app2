<template>
    <div class="max-w-xl mx-auto p-2 flex justify-between">
        <div class="flex items-center">
            <DocumentSvg/>
            <h2 class="font-bold text-lg text-gray-800">
                保存されたメモ
            </h2>
        </div>

        <div class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full">
            <p>{{memos.length}}件</p>
        </div>

    </div>
    <p v-if="memos.length === 0" class="text-center text-gray-500 p-5">
        まだメモがありません。上のフォームから最初のメモを追加しましょう！
    </p>
    <div v-for="memo in memos" :key="memo.id" class="max-w-xl mx-auto bg-white rounded-xl shadow-md p-6 mt-4 flex flex-col group">
        <div class="flex justify-end justify-between">
            <p>{{ memo.content }}</p>
            <button @click="$emit('delete-memo',memo.id)" class="p-1 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200>"><TrashSvg/></button>
        </div>
        <div class="flex">
        <span class="text-sm text-gray-400">{{ memo.created_at }}</span>
        </div>
    </div>

</template>
<script setup lang="ts">
import { PropType } from 'vue';
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import TrashSvg from "@/components/svgs/TrashSvg.vue";
interface Memo {
    id: number;
    content: string;
    created_at: string;
    updated_at: string;
}
defineProps({
    memos:{
    type:Array as PropType<Memo[]>,
    required:true,
    },
})
</script>
