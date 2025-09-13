<script setup lang="ts">
import Layout from "../features/Layout.vue";
import memoForm from "../components/memoForm/MemoForm.vue";
import memoList from"../components/memoList/MemoList.vue";
</script>

<template>
    <Layout>
      <MemoForm/>
      <MemoList/>
    </Layout>
</template>
