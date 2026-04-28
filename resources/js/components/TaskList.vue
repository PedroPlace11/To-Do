<template>
    <div v-if="tasks.length === 0" class="text-center text-gray-500 dark:text-slate-400 py-8">
        <p>Nenhuma tarefa encontrada. Adicione uma nova!</p>
    </div>
    <ul v-else class="space-y-3">
        <li v-for="task in tasks" :key="task.id"
            class="bg-gray-100 dark:bg-slate-800 rounded-lg p-4 flex flex-col sm:flex-row sm:items-center gap-3 hover:bg-gray-200 dark:hover:bg-slate-700 transition border border-transparent dark:border-slate-700">
            <div class="flex-1">
                <div class="font-semibold text-lg" :class="priorityColor(task.priority)">{{ task.title }}</div>
                <p v-if="task.description" class="text-sm text-gray-600 dark:text-slate-300 mt-1">{{ task.description }}
                </p>
                <div class="text-xs text-gray-500 dark:text-slate-400 mt-2 flex flex-wrap gap-3">
                    <span>📅 {{ task.due_date || 'Sem data' }}</span>
                    <span>🎯 {{ priorityLabel(task.priority) }}</span>
                    <span :class="statusColor(task.status)">{{ task.status === 'pendente' ? 'Pendente ⏳' : 'Concluída ✓'
                        }}</span>
                </div>
            </div>
            <div class="flex gap-2 justify-end sm:flex-col">
                <button @click="$emit('edit', task)"
                    class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-semibold px-2 py-1 bg-blue-50 dark:bg-blue-950/50 rounded">Editar
                    ✏️</button>
                <button v-if="task.status === 'pendente'" @click="$emit('complete', task)"
                    class="text-green-600 dark:text-green-400 hover:underline text-sm font-semibold px-2 py-1 bg-green-50 dark:bg-green-950/50 rounded">Concluir
                    ✔️</button>
                <button @click="$emit('delete', task)"
                    class="text-red-600 dark:text-red-400 hover:underline text-sm font-semibold px-2 py-1 bg-red-50 dark:bg-red-950/50 rounded">Excluir
                    🗑️</button>
            </div>
        </li>
    </ul>
</template>

<script setup>
const props = defineProps({
    tasks: Array
});

function priorityColor(priority) {
    if (priority === 'alta') return 'text-red-600';
    if (priority === 'media') return 'text-yellow-600';
    return 'text-green-600';
}

function priorityLabel(priority) {
    if (priority === 'alta') return 'Prioridade: Alta';
    if (priority === 'media') return 'Prioridade: Média';
    return 'Prioridade: Baixa';
}

function statusColor(status) {
    return status === 'concluida' ? 'text-green-600' : 'text-yellow-600';
}
</script>
