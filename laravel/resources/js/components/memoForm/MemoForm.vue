<template>
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md p-6 sm:p-8">

        <div class="flex items-center mb-5">
            <CardTitle/>
        </div>

        <div>
            <TextareaForm v-model="memoText"
            @submit="handleSave"/>
        </div>
        <button
            v-if="props.editingMemo"
            @click="$emit('cancel-edit')"
            class="px-6 py-3 text-gray-600 font-bold bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors"
        >
            キャンセル
        </button>
        <Buttons :is-disabled="memoText.length === 0"
                 @save="handleSave" />
    </div>
</template>

<script setup lang="ts">
import {ref,watch} from "vue";
import TextareaForm from "@/components/memoForm/TextareaForm.vue";
import Buttons from "@/components/memoForm/Buttons.vue";
import CardTitle from "@/components/memoForm/CardTitle.vue";
import axios from 'axios';

const props = defineProps<{
    editingMemo: Memo | null;
}>();
const emit = defineEmits<{
    (e: 'memo-saved', newMemo: any): void;
    (e: 'memo-updated', updatedMemo: any): void;
    (e: 'cancel-edit'): void;
}>();


const memoText=ref("");

watch(() => props.editingMemo, (newVal) => {
    if (newVal) {
        memoText.value = newVal.content; // 編集モード：内容をセット
    } else {
        memoText.value = ''; // 新規モード：空にする
    }
}, { immediate: true }); // immediate: trueで初期表示時も実行
const handleSave = async () => {
    if (props.editingMemo) {
        // 更新処理 (PUT)
        const response = await axios.put(`/api/memos/${props.editingMemo.id}`, {
            content: memoText.value,
        });
        emit('memo-updated', response.data);
        memoText.value='';
    } else {
        // 新規作成処理 (POST)
        const response = await axios.post('/api/memos', {
            content: memoText.value,
        });
        emit('memo-saved', response.data);
        memoText.value='';
    }
};


</script>

