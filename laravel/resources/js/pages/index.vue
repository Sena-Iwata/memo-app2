<template>
        <layout/>
    <memoForm class="mt-8" @memo-saved="addNewMemoToList"/>
        <memoList :memos="memos" @delete-memo="deleteMemos"/>
</template>
<script setup lang="ts">
import Layout from "../features/Layout.vue";
import memoForm from "../components/memoForm/MemoForm.vue";
import memoList from"../components/memoList/MemoList.vue";
import {ref} from "vue";
import axios from "axios";
import { onMounted } from "vue";

interface Memo {
    id: number;
    content: string;
    created_at: string;
    updated_at: string;
}
interface MemoApiResponse {
    data: Memo;
}
const memos=ref<Memo[]>([]);

const fetchMemos=async()=>{
    try{
        const response=await axios.get('/api/memos')
        memos.value=response.data.data;
    }
    catch (error) {
        console.error('メモの取得に失敗しました:', error);
        alert('メモの読み込みに失敗しました。');
    }
};
onMounted(() => {
    fetchMemos();
});
const deleteMemos=async(memoId :number)=> {
    try {
        await axios.delete(`/api/memos/${memoId}`);
        memos.value = memos.value.filter(memo => memo.id !== memoId);

    } catch (error) {
        console.error('メモの削除に失敗しました:', error);
        alert('メモの削除に失敗しました。');
    }
};
const addNewMemoToList = (newMemoResponse: MemoApiResponse) => {
    memos.value.unshift(newMemoResponse.data);
};
</script>
