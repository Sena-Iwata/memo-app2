<template>
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md p-6 sm:p-8">

        <div class="flex items-center mb-5">
            <CardTitle/>
        </div>

        <div>
            <TextareaForm v-model="memoText"
            @submit="handleSave"/>
        </div>
        <Buttons :is-disabled="memoText.length === 0"
                 @save="handleSave" />
    </div>
</template>

<script setup lang="ts">
import {ref} from "vue";
import TextareaForm from "@/components/memoForm/TextareaForm.vue";
import Buttons from "@/components/memoForm/Buttons.vue";
import CardTitle from "@/components/memoForm/CardTitle.vue";
import axios from 'axios';

const emit = defineEmits<{
    (e: 'memo-saved', newMemo: any): void;
}>();

const memoText=ref("");
const handleSave = async () => {
    if (memoText.value.length === 0) {
        return;
    }
    try {
        // LaravelのAPIエンドポイントにPOSTリクエストを送信
        const response = await axios.post('/api/memos', {
            content: memoText.value,
        });
        emit('memo-saved', response.data);
        console.log('保存成功:', response.data);
        memoText.value = '';
    } catch (error) {
        console.error('保存失敗:', error);
    }
};


</script>

