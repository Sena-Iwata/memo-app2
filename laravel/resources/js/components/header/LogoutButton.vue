<template>
    <nav>
        <button @click="logout" class="text-red-500">ログアウト</button>
    </nav>
</template>
<script setup lang="ts">
import { router } from '@inertiajs/vue3';
const logout = () => {
    router.post('/logout');
};
</script>
