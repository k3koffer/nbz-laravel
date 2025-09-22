<script setup>
import { ref, computed } from 'vue';
import BlogArticlePreview from '@/Blog/Components/Shared/BlogArticlePreview.vue';

let props = defineProps({
    articles: Object
});

// 2. Создаем вычисляемое свойство для группировки статей
const groupedArticles = computed(() => {
    // Делаем копию массива, чтобы не изменять оригинальные пропсы
    const articlesCopy = [...props.articles.data];
    const groups = [];

    // Цикл работает, пока в копии есть статьи
    while (articlesCopy.length > 0) {
        // Получаем случайное число: 2 или 3
        const randomAmount = Math.floor(Math.random() * 2) + 2;

        // Определяем, сколько статей взять в эту строку.
        // Используем Math.min, чтобы избежать ошибки, если в конце осталось меньше статей, чем выпало в random.
        const groupSize = Math.min(randomAmount, articlesCopy.length);

        // Вырезаем нужное количество статей из начала массива и добавляем их как новую группу (строку)
        groups.push(articlesCopy.splice(0, groupSize));
    }

    return groups;
});

// 3. (Опционально) Вспомогательная функция для определения CSS-класса
const getArticleClass = (row) => {
    const size = row.length;

    // Если в строке 3 статьи (маленькая строка), каждая занимает 1/3
    if (size === 3) {
        return 'col-lg-4';
    }
    // Если в строке 2 статьи (средняя строка), каждая занимает 1/2
    if (size === 2) {
        return 'col-lg-6';
    }
    // Если в конце осталась 1 статья, она может занимать всю ширину или половину.
    // Класс col-lg-6 (половина) часто выглядит лучше, чем col-lg-12 (вся ширина).
    if (size === 1) {
        return 'col-lg-12';
    }

    return ''; // На всякий случай
};
</script>

<template>
    <div v-for="(row, rowIndex) in groupedArticles" :key="`row-${rowIndex}`" class="row mx-0">
        <!-- 5. Внутренний цикл отрисовывает статьи ВНУТРИ каждой строки -->
        <div v-for="article in row" :key="article.id" class="col-12 px-0 py-4" :class="getArticleClass(row)">
            <blog-article-preview :article="article" :size="row.length" />
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .not-found-wrapper {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column-reverse;
    }

    .not-found {
        width: fit-content;
        color: rgb(223, 223, 223);
        font-family: 'Inter', sans-serif;
        font-weight: 400;
        font-size: 20px;
    }

    .not-found-description {
        color: #a3a3a3;
        font-family: 'Inter', sans-serif;
        font-weight: 300;
        font-size: 16px;
        text-align: center;

        a {
            color: rgb(64, 71, 136);
            text-decoration: none;
            transition: 0.2s;
        }

        a:hover {
            color: rgb(83, 92, 177);
            text-decoration: underline;
        }
    }
</style>