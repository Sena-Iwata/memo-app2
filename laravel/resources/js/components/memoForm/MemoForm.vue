<template>
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md p-6 sm:p-8">

        <div class="flex items-center mb-5">
            <CardTitle/>
        </div>

        <div>
            <TextareaForm v-model="memoText"/>
        </div>
        <Buttons :is-disabled="memoText.length === 0" />
    </div>
</template>

<script setup lang="ts">
import {ref} from "vue";
import TextareaForm from "@/components/memoForm/TextareaForm.vue";
import Buttons from "@/components/memoForm/Buttons.vue";
import CardTitle from "@/components/memoForm/CardTitle.vue";

const memoText=ref("");
</script>

