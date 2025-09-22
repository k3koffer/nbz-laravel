<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  status: Number,
});

const title = computed(() => {
  return {
    503: 'Сервис недоступен',
    500: 'Ошибка сервера',
    404: 'Страница не найдена',
    403: 'Доступ запрещен',
  }[props.status];
});

const description = computed(() => {
  return {
    503: 'Извините, мы проводим техническое обслуживание. Пожалуйста, зайдите позже.',
    500: 'Упс, что-то пошло не так на нашей стороне.',
    404: 'Извините, страница, которую вы ищете, не найдена.',
    403: 'Извините, у вас нет прав для доступа к этой странице.',
  }[props.status];
});
</script>

<template>
  <Head :title="title" />

  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center">
      <h1 class="text-6xl font-bold text-gray-800">{{ status }}</h1>
      <p class="text-2xl font-light text-gray-600 mt-2">{{ title }}</p>
      <p class="mt-4 text-gray-500">{{ description }}</p>
      <div class="mt-6">
        <Link
          href="/"
          class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700"
        >
          Вернуться на главную
        </Link>
      </div>
    </div>
  </div>
</template>