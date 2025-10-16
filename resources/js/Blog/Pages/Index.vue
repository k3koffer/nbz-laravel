<script setup>
import AppLayout from '@/Blog/Layouts/AppLayout.vue';
import BlogSearch from '@/Blog/Components/Blogpage/BlogSearch.vue';
import ArticleList from '@/Blog/Components/Blogpage/ArticleList.vue';

let props = defineProps({
    posts: Object,
    filters: Object
});

</script>

<template>
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
    .index-body {
        background-color: $bg-main;
        padding: 100px 0 50px 0;
    }

    .article-list {
        margin: 0 auto;
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