<template>
    <header class="bg-white py-8">
        <div class="flex flex-col items-center justify-center">
            <div class="flex items-center">
                <DocumentSvg/>
                <h1 class="ml-2 text-3xl font-bold text-orange-500">かんたんメモ</h1>
            </div>
            <p class="mt-2 text-gray-600">思いついたことをサッと記録しよう</p>
        </div>
    </header>
</template>
<script setup>
import {defineComponent} from "vue";
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
</script>
