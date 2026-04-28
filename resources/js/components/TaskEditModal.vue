<template>
    <div v-if="isOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center p-4">
        <div
            class="bg-white dark:bg-slate-900 rounded-lg shadow-lg p-6 w-full max-w-md border border-transparent dark:border-slate-700">
            <h2 class="text-xl font-bold mb-4 text-slate-900 dark:text-slate-100">Editar Tarefa</h2>
            <form @submit.prevent="saveTask" class="flex flex-col gap-3">
                <input v-model="form.title" type="text" placeholder="Título"
                    class="border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded px-2 py-1"
                    required />
                <textarea v-model="form.description" placeholder="Descrição"
                    class="border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded px-2 py-1 h-20"></textarea>
                <input v-model="form.due_date" type="date"
                    class="border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded px-2 py-1" />
                <select v-model="form.priority"
                    class="border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded px-2 py-1">
                    <option value="alta">Alta</option>
                    <option value="media">Média</option>
                    <option value="baixa">Baixa</option>
                </select>
                <div class="flex gap-2 justify-end">
                    <button type="button" @click="close"
                        class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded hover:bg-gray-100 dark:hover:bg-slate-800 text-slate-900 dark:text-slate-100">Cancelar</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    task: Object
});

const emit = defineEmits(['save', 'close']);

const isOpen = ref(false);
const form = ref({});

function open() {
    if (props.task) {
        form.value = { ...props.task };
        isOpen.value = true;
    }
}

function close() {
    isOpen.value = false;
}

function saveTask() {
    emit('save', form.value);
    close();
}

defineExpose({ open, close });
</script>
