<template>
        <layout/>
    <memoForm class="mt-8"/>
        <memoList :memos="memos"/>
</template>
<script setup lang="ts">
import Layout from "../features/Layout.vue";
import memoForm from "../components/memoForm/MemoForm.vue";
import memoList from"../components/memoList/MemoList.vue";
import {ref} from "vue";
import axios from "axios";
import { onMounted } from "vue";
const memos=ref([]);

const fetchMemos=async()=>{
    try{
        const response=await axios.get('/api/memos')
        console.log('APIから返ってきた実際のデータ:', response.data);
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
</script>
