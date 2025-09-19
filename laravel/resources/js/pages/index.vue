<template>
        <layout/>
    <memoForm class="mt-8" @memo-saved="addNewMemoToList" @memo-updated="updateMemoInList" :editing-memo="editingMemo" @cancel-edit="cancelEditing"/>
        <memoList :memos="memos" @delete-memo="deleteMemos" @edit-memo="startEditing"/>
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
const editingMemo=ref<Memo|null>(null)
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

const startEditing=(memo:Memo)=>{
    editingMemo.value=memo;
}
const cancelEditing = () => {
    editingMemo.value = null;
};
// 1. 引数の名前と型を、受け取るデータの実際の形に合わせる
const updateMemoInList = (updatedMemoResponse: { data: Memo }) => {

    // 2. まず「包装紙」を剥がして、中のメモ本体を取り出す
    const updatedMemo = updatedMemoResponse.data;

    // 3. 取り出したメモ本体を使って、配列内を検索する
    const index = memos.value.findIndex(memo => Number(memo.id) === Number(updatedMemo.id));

    if (index !== -1) {
        // 4. 配列の要素を、取り出したメモ本体で更新する
        memos.value[index] = updatedMemo;
    } else {
        console.error('更新対象のメモが配列内に見つかりませんでした。');
    }

    cancelEditing();
};
</script>
