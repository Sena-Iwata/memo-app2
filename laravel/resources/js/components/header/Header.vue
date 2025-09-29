<template>
    <header class="bg-white py-8 dark:bg-gray-800/70 dark:border-b dark:border-gray-700">
        <div class="flex flex-col items-center justify-center">
            <div class="flex items-center">
                <DocumentSvg/>
                <h1 class="ml-2 text-3xl font-bold text-orange-500 dark:text-gray-100">かんたんメモ</h1>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">思いついたことをサッと記録しよう</p>
        </div>
    </header>
    <DarkModeToggle />
</template>
<script setup>
import DarkModeToggle from "@/components/DarkModeToggle.vue";
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
</script>
