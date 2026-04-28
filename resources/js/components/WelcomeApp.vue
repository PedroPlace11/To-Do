<template>
  <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-cyan-100 text-gray-900 transition-colors dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 dark:text-slate-100">
    <nav class="sticky top-0 z-50 border-b border-blue-100 bg-white/80 backdrop-blur dark:border-slate-700 dark:bg-slate-900/80">
      <div class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-4">
        <a href="/" class="inline-flex" aria-label="Voltar para a pagina principal">
          <img :src="'/image/logo/ToDo.png'" alt="To-Do App" class="h-16 w-auto" />
        </a>
        <a href="/todo" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
          Abrir App
        </a>
      </div>
    </nav>

    <button
      id="theme-toggle"
      type="button"
      class="fixed bottom-4 right-4 z-50 rounded-full border border-slate-300 bg-white p-3 shadow-md transition hover:scale-105 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900 dark:hover:bg-slate-800"
      aria-label="Alternar tema"
      title="Alternar tema"
      @click="toggleTheme"
    >
      <svg v-show="!isDark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
        <circle cx="12" cy="12" r="4"></circle>
        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"></path>
      </svg>
      <svg v-show="isDark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
        <path d="M21 12.79A9 9 0 1 1 11.21 3c0.25 0 0.5 0.01 0.75 0.04A7 7 0 0 0 21 12.79z"></path>
      </svg>
    </button>

    <section class="px-6 pb-16 pt-20">
      <div class="mx-auto max-w-5xl text-center">
        <h1 class="text-4xl font-extrabold leading-tight text-slate-900 md:text-6xl dark:text-slate-100">
          Organize suas tarefas com clareza e velocidade
        </h1>
        <p class="mx-auto mt-6 max-w-3xl text-lg text-slate-600 md:text-xl dark:text-slate-300">
          Transforme sua rotina com um To-Do rapido e inteligente: organize tarefas, defina prioridades e acompanhe cada status em tempo real.
        </p>
      </div>
    </section>

    <section id="features" class="bg-white/70 px-6 py-16 dark:bg-slate-900/40">
      <div class="mx-auto max-w-6xl">
        <h2 class="text-center text-3xl font-bold text-slate-900 md:text-4xl dark:text-slate-100">Funcionalidades principais</h2>
        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800/80">
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">CRUD completo</h3>
            <p class="mt-2 text-slate-600 dark:text-slate-300">Criar, editar, concluir e excluir tarefas rapidamente.</p>
          </article>
          <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800/80">
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Filtros inteligentes</h3>
            <p class="mt-2 text-slate-600 dark:text-slate-300">Filtragem por status, prioridade e data de vencimento.</p>
          </article>
          <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800/80">
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Prioridades</h3>
            <p class="mt-2 text-slate-600 dark:text-slate-300">Classificacao em alta, media e baixa para foco diario.</p>
          </article>
          <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800/80">
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Interface responsiva</h3>
            <p class="mt-2 text-slate-600 dark:text-slate-300">Experiencia adaptada para celular, tablet e desktop.</p>
          </article>
          <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800/80">
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Notificacoes</h3>
            <p class="mt-2 text-slate-600 dark:text-slate-300">Feedback visual para operacoes de sucesso e erro.</p>
          </article>
          <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800/80">
            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Tecnologia moderna</h3>
            <p class="mt-2 text-slate-600 dark:text-slate-300">Laravel 12 no backend e Vue 3 no frontend.</p>
          </article>
        </div>
      </div>
    </section>

    <footer class="border-t border-slate-200 bg-white/70 px-6 py-8 text-center text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-900/60 dark:text-slate-300">
      <p>&copy; {{ year }} Inovcorp. Todos os direitos reservados.</p>
    </footer>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const isDark = ref(false);
const year = new Date().getFullYear();

function syncThemeState() {
  isDark.value = document.documentElement.classList.contains('dark');
}

function toggleTheme() {
  const dark = document.documentElement.classList.toggle('dark');
  localStorage.setItem('theme', dark ? 'dark' : 'light');
  isDark.value = dark;
}

onMounted(syncThemeState);
</script>
