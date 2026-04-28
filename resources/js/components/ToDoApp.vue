<template>
    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 text-gray-900 dark:from-slate-900 dark:to-slate-800 dark:text-slate-100 flex flex-col items-center p-4 py-8">
        <div class="w-full max-w-2xl">
            <div class="mb-3 flex justify-center">
                <a href="/" class="inline-flex" aria-label="Voltar para a pagina principal">
                    <img :src="'/image/logo/ToDo.png'" alt="To-Do App" class="h-20 w-auto" />
                </a>
            </div>
            <p class="text-center text-gray-600 dark:text-slate-300 mb-6">Organize suas tarefas com eficiência</p>

            <div
                class="bg-white dark:bg-slate-900 rounded-lg shadow-lg p-6 border border-transparent dark:border-slate-700">
                <!-- Filtros -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
                    <div>
                        <label
                            class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Estado</label>
                        <select v-model="filterStatus"
                            class="w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Todas</option>
                            <option value="pendente">Pendentes</option>
                            <option value="concluida">Concluídas</option>
                        </select>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Prioridade</label>
                        <select v-model="filterPriority"
                            class="w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Todas</option>
                            <option value="alta">Alta</option>
                            <option value="media">Média</option>
                            <option value="baixa">Baixa</option>
                        </select>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Ordenação</label>
                        <select v-model="sortOrder"
                            class="w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="asc">Mais próximas</option>
                            <option value="desc">Mais distantes</option>
                        </select>
                    </div>
                </div>

                <!-- Formulário -->
                <TaskForm @task-added="addTask" />

                <!-- Loading -->
                <div v-if="loading" class="text-center py-4 text-gray-500 dark:text-slate-400">Carregando...</div>

                <!-- Lista de Tarefas -->
                <TaskList v-else :tasks="filteredTasks" @edit="openEditModal" @complete="completeTask"
                    @delete="deleteTask" />
            </div>
        </div>

        <!-- Notificação -->
        <NotificationToast :type="notificationType" :text="notificationText" />

        <!-- Modal de Edição -->
        <TaskEditModal ref="editModal" :task="editingTask" @save="saveTask" />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import TaskForm from './TaskForm.vue';
import TaskList from './TaskList.vue';
import NotificationToast from './NotificationToast.vue';
import TaskEditModal from './TaskEditModal.vue';

const tasks = ref([]);
const loading = ref(false);
const filterStatus = ref('');
const filterPriority = ref('');
const sortOrder = ref('asc');
const editingTask = ref(null);
const editModal = ref(null);

const notificationText = ref('');
const notificationType = ref('info');
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute('content') || '';

const filteredTasks = computed(() => {
    let list = [...tasks.value];
    if (filterStatus.value) {
        list = list.filter(t => t.status === filterStatus.value);
    }
    if (filterPriority.value) {
        list = list.filter(t => t.priority === filterPriority.value);
    }
    list = list.sort((a, b) => {
        if (!a.due_date) return 1;
        if (!b.due_date) return -1;
        return sortOrder.value === 'asc'
            ? new Date(a.due_date) - new Date(b.due_date)
            : new Date(b.due_date) - new Date(a.due_date);
    });
    return list;
});

function showNotification(message, type = 'info') {
    notificationText.value = message;
    notificationType.value = type;
}

async function fetchTasks() {
    loading.value = true;
    try {
        const res = await fetch('/tasks');
        if (!res.ok) throw new Error('Erro ao buscar tarefas');
        tasks.value = await res.json();
    } catch (error) {
        showNotification('Erro ao carregar tarefas', 'error');
    } finally {
        loading.value = false;
    }
}

async function addTask(task) {
    loading.value = true;
    try {
        const res = await fetch('/tasks', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
            },
            body: JSON.stringify(task)
        });
        if (!res.ok) throw new Error('Erro ao adicionar tarefa');
        await fetchTasks();
        showNotification('Tarefa adicionada com sucesso!', 'success');
    } catch (error) {
        showNotification('Erro ao adicionar tarefa', 'error');
    } finally {
        loading.value = false;
    }
}

function openEditModal(task) {
    editingTask.value = task;
    editModal.value?.open();
}

async function saveTask(updatedTask) {
    loading.value = true;
    try {
        const res = await fetch(`/tasks/${updatedTask.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
            },
            body: JSON.stringify(updatedTask)
        });
        if (!res.ok) throw new Error('Erro ao atualizar tarefa');
        await fetchTasks();
        showNotification('Tarefa atualizada com sucesso!', 'success');
    } catch (error) {
        showNotification('Erro ao atualizar tarefa', 'error');
    } finally {
        loading.value = false;
    }
}

async function completeTask(task) {
    loading.value = true;
    try {
        const res = await fetch(`/tasks/${task.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
            },
            body: JSON.stringify({ status: 'concluida' })
        });
        if (!res.ok) throw new Error('Erro ao concluir tarefa');
        await fetchTasks();
        showNotification('Tarefa concluída!', 'success');
    } catch (error) {
        showNotification('Erro ao concluir tarefa', 'error');
    } finally {
        loading.value = false;
    }
}

async function deleteTask(task) {
    if (!confirm('Tem certeza que deseja excluir esta tarefa?')) return;

    loading.value = true;
    try {
        const res = await fetch(`/tasks/${task.id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
            }
        });
        if (!res.ok) throw new Error('Erro ao excluir tarefa');
        await fetchTasks();
        showNotification('Tarefa excluída com sucesso!', 'success');
    } catch (error) {
        showNotification('Erro ao excluir tarefa', 'error');
    } finally {
        loading.value = false;
    }
}

onMounted(fetchTasks);
</script>

<style scoped></style>
