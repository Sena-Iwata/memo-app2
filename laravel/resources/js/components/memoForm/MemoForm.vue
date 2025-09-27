<template>
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md p-6 sm:p-8">

        <div class="flex items-center mb-5">
            <CardTitle/>
        </div>

        <div>
            <TextareaForm v-model="memoText"
            @submit="handleSave"/>
        </div>
        <button
            v-if="props.editingMemo"
            @click="$emit('cancel-edit')"
            class="px-6 py-3 text-gray-600 font-bold bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors"
        >
            キャンセル
        </button>
        <Buttons :is-disabled="memoText.length === 0"
                 @save="handleSave" />
    </div>
</template>

<script setup lang="ts">
import {ref,computed} from "vue";
import TextareaForm from "@/components/memoForm/TextareaForm.vue";
import Buttons from "@/components/memoForm/Buttons.vue";
import CardTitle from "@/components/memoForm/CardTitle.vue";

interface Memo {
    id: number;
    content: string;
    created_at: string;
    updated_at: string;
}

const props = defineProps<{
    modelValue: string;
    editingMemo: Memo | null;
}>();
const emit = defineEmits<{
    (e: 'update:modelValue', value: string): void;
    (e: 'memo-saved'): void;
    (e: 'memo-updated', data: { id: number; content: string }): void;
    (e: 'cancel-edit'): void;
}>();


const memoText=computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value),
});


const handleSave = async () => {
    if (props.editingMemo) {
        emit('memo-updated', { id: props.editingMemo.id, content: memoText.value });
    } else {
        emit('memo-saved');
    }
};


</script>

