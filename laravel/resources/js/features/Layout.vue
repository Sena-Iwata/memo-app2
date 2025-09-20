<template>
    <Appheader/>
<div class="flex justify-end">
    <LogoutButton/>
</div>
</template>
<script setup>
import Appheader from "@/components/header/Header.vue";
import LogoutButton from "@/components/header/LogoutButton.vue";
</script>
<style>
html, body, #app {
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
    background: linear-gradient(135deg, #fffaf5, #fdeee6, #fff6e9);
    background-attachment: fixed;
}
</style>
