<script setup>
import Header from '@/Blog/Components/Shared/Header.vue';
import Footer from '@/Blog/Components/Shared/Footer.vue';
import Notification from '@/Blog/Components/Shared/Notification.vue';
import { computed } from 'vue';
import { usePage, Head } from '@inertiajs/vue3';

const page = usePage();

let meta = computed(() => {
  return page.props.meta;
});

const showHeader = computed(() => page.props.show_header !== false);
const showFooter = computed(() => page.props.show_footer !== false);
</script>

<template>
    <Head v-if="meta" :title="meta.title">
        <meta name="description" :content="meta.description" />
        <meta property="og:title" :content="meta.title" />
        <meta property="og:description" :content="meta.description" />
        <meta property="og:image" :content="meta.image" />
        <meta property="og:url" :content="meta.url" />
        <meta property="og:type" :content="meta.type" />
        <meta property="og:site_name" content="Не Бойся Знать - образовательная платформа" />
        <meta property="og:locale" content="ru_RU" />
    </Head>

    <Header v-if="showHeader" />
    <transition name="fade" mode="out-in" appear>
        <main :key="$page.url">
          <slot />
          <notification />
        </main>

    </transition>
    <Footer v-if="showFooter" />
</template>