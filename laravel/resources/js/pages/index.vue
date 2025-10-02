<template>
  <layout/>
  <div class="mb-4 justify-center">
    <input
        type="text"
        v-model="searchQuery"
        placeholder="メモを検索..."
        class="w-100 px-4 py-2 border rounded-md"
    />
  </div>

  <memoForm class="mt-8" v-model="memoText" @memo-saved="handleSave" @memo-updated="updateMemoInList" :editing-memo="editingMemo" @cancel-edit="cancelEditing"/>
        <memoList :memos="memos" @delete-memo="deleteMemos" @edit-memo="startEditing"/>
</template>
<script setup lang="ts">
import Layout from "../features/Layout.vue";
import memoForm from "../components/memoForm/MemoForm.vue";
import memoList from "../components/memoList/MemoList.vue";
import {ref,watch} from "vue";
import axios from "axios";
import { onMounted } from "vue";

interface Memo {
    id: number;
    content: string;
    created_at: string;
    updated_at: string;
}
const memos=ref<Memo[]>([]);
const editingMemo=ref<Memo|null>(null)
const memoText = ref('');
const searchQuery = ref('');

watch(searchQuery, () => {
  // ユーザーの入力を待つために、少し遅延させてからAPIを呼ぶ（デバウンス）
  setTimeout(() => {
    fetchMemos();
  }, 300); // 300ミリ秒
});
const fetchMemos = async () => {
  try {
    const response = await axios.get('/api/memos', {
      // クエリパラメータとして検索キーワードを送信
      params: {
        search: searchQuery.value
      }
    });
    memos.value = response.data.data;}
    catch (error) {
        console.error('メモの取得に失敗しました:', error);
        alert('メモの読み込みに失敗しました。');
    }
};
onMounted(() => {
    fetchMemos();
});
const handleSave = async () => {
    if (memoText.value.length === 0) {
        return;
    }
    try {
        const response = await axios.post('/api/memos', {
            content: memoText.value,
        });
        memos.value.unshift(response.data.data);
        memoText.value = '';
    } catch (error) {
        console.error('保存失敗:', error);
    }
};

const updateMemoInList = async (memoToUpdate: { id: number; content: string }) => {
    try {
        const response = await axios.put(`/api/memos/${memoToUpdate.id}`, {
            content: memoToUpdate.content
        });

        const updatedMemo = response.data.data;

        const index = memos.value.findIndex(memo => memo.id === updatedMemo.id);
        if (index !== -1) {
            memos.value[index] = updatedMemo;
        }
        cancelEditing();
    } catch (error) {
        console.error('更新失敗:', error);
    }
};
const deleteMemos=async(memoId :number)=> {

    if(!confirm('本当にこのメモを削除しますか？')){
        return;
    }

    try {
        await axios.delete(`/api/memos/${memoId}`);
        memos.value = memos.value.filter(memo => memo.id !== memoId);

    } catch (error) {
        console.error('メモの削除に失敗しました:', error);
        alert('メモの削除に失敗しました。');
    }
};

const startEditing = (memo: Memo) => {
    editingMemo.value = memo;
    memoText.value = memo.content;
};
const cancelEditing = () => {
    editingMemo.value = null;
    memoText.value = '';
};


</script>
