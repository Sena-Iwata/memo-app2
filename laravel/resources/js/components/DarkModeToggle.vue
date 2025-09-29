<script setup lang="ts">
import { ref, onMounted } from 'vue';

// 'dark' or 'light'
const currentTheme = ref('light');

// テーマを切り替える関数
const toggleTheme = () => {
    const newTheme = currentTheme.value === 'light' ? 'dark' : 'light';
    applyTheme(newTheme);
};

// 実際にテーマを適用し、localStorageに保存する関数
const applyTheme = (theme: string) => {
    currentTheme.value = theme;
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    localStorage.setItem('theme', theme);
};

// コンポーネントがマウントされた時に、localStorageから設定を読み込む
onMounted(() => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);
});
</script>

<template>
    <button @click="toggleTheme" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
        <!-- ライトモードの時に月のアイコンを表示 -->
        <svg v-if="currentTheme === 'light'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>
        <!-- ダークモードの時に太陽のアイコンを表示 -->
        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-15.66l-.707.707M4.04 19.96l-.707.707M21 12h-1M4 12H3m15.66 8.66l-.707-.707M4.04 4.04l-.707-.707"></path>
        </svg>
    </button>
</template>
