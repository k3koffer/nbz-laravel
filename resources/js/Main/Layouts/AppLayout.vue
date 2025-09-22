<script setup>
import Header from '@/Main/Components/Shared/Header.vue';
import Footer from '@/Main/Components/Shared/Footer.vue';
import Notification from '@/Main/Components/Shared/Notification.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const showHeader = computed(() => page.props.show_header !== false);
const showFooter = computed(() => page.props.show_footer !== false);
</script>

<template>
    <Header v-if="showHeader" />
    <transition name="fade" mode="out-in" appear>
        <main :key="$page.url">
          <slot />
          <notification />
        </main>

    </transition>
    <Footer v-if="showFooter" />
</template>