<script setup>
import AppLayout from '@/Blog/Layouts/AppLayout.vue';
import BlogSearch from '@/Blog/Components/Blogpage/BlogSearch.vue';
import ArticleList from '@/Blog/Components/Blogpage/ArticleList.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

let props = defineProps({
    posts: Object,
    filters: Object
});

let currentUrl = computed(() => {
    return window.location.href;
});

</script>

<template>
    <Head title="НБЗ | Блог">
        <meta name="description" content="Наши молодые и энергичные преподаватели говорят с ребятами на одном языке, так что забудьте о зубрежке и непонимании — мы предлагаем интерактивные уроки, интересные задания и живое общение. Не Бойся Знать — это ваш путь к знаниям без страха и скуки!" />
        <meta property="og:title" content="НеБойсяЗнать - Блог" />
        <meta property="og:description" content="Наши молодые и энергичные преподаватели говорят с ребятами на одном языке, так что забудьте о зубрежке и непонимании — мы предлагаем интерактивные уроки, интересные задания и живое общение. Не Бойся Знать — это ваш путь к знаниям без страха и скуки!" />
        <!-- <meta property="og:image" :content="`https://ik.imagekit.io/3dwnck0ax/blog_overlays/`" /> -->
        <meta property="og:url" :content="currentUrl" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="НеБойсяЗнать - образовательная платформа" />
        <meta property="og:locale" content="ru_RU" />
    </Head>
    
    <AppLayout>
        <section class="index-body">
            <transition name="fade" mode="out-in"> 
                <div class="article-list">
                    <div class="blog-search-wrapper d-flex justify-content-center">
                        <blog-search />
                    </div>
                    <article-list :articles="posts" />
                </div>
            </transition>
        </section>
    </AppLayout>
    
</template>

<style lang="scss" scoped>
    .article-list {
        margin: 100px auto 50px auto;
        width: 100%;
        @include media-breakpoint-up(md) {
            width: 70%;
        }
        min-height: 700px;
        height: fit-content;
        background-color: rgb(247, 241, 227);
        border-radius: 20px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;        
        padding: 10px;
    }
</style>