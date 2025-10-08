<script setup>
import { computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { useUiStore } from '@/Blog/Stores/ui';

let uiStore = useUiStore();
let page = usePage();

let onSearchClick = function () {
    if (page.url === '/') {
        uiStore.toggleSearch();
    } else {
        router.visit('/');
    }
};

const currentSort = computed(() => page.props.query?.sortBy || 'new');

function applySort(sortType) {
    if (currentSort.value === sortType) return

    router.get(
        '/',
        {
            ...page.props.query,
            sortBy: sortType,
        },
        {
            // Опции для улучшения UX, как и в <Link>
            preserveState: true,
            preserveScroll: true,
            replace: true,
        }
    );
}
</script>

<template>
    <header style="transition: 0.2s; transition-timing-function: ease-in;" class="row mx-0 top-0">
        <div class="col-12 col-xl-6 col-xxl-6 d-flex justify-content-start px-0 py-0">
            <Link class="d-flex text-decoration-none mx-auto mx-xl-5" href="/">
                <div class="logo"><img alt="Логотип НеБойсяЗнать | Блог" src="https://ik.imagekit.io/3dwnck0ax/logo_blog_transparent.png?updatedAt=1758560102058"></div>
            </Link>
        </div>
        <nav class="func col-12 col-xl-6 col-xxl-6 d-flex">
            <div class="home d-flex align-items-center px-2 py-1">
                    <a href="/main">
                        <i class="fa-solid fa-house nav-icon"></i>
                    </a>
                </div>
            <div id="search-trigger-button" class="search d-flex align-items-center px-2 py-1" @click="onSearchClick">
                <i class="fa-solid fa-magnifying-glass nav-icon"></i>
            </div>
            <div class="sort">
                <button class="d-inline-flex">
                    <span @click="applySort('new')" class="px-2 new" :class="{ 'active': currentSort === 'new' }">НОВЫЕ </span> 
                    / 
                    <span @click="applySort('best')" class="px-2 best" :class="{ 'active': currentSort === 'best' }"> ЛУЧШИЕ</span>
                </button>
            </div>
        </nav>
    </header>
</template>

<style lang="scss" scoped>
    header {
        width: 100%;
        min-height: 80px;
        height: fit-content;
        background: #F8F6F0;
        z-index: 100;
        position: relative;

        .tippy-content {
            padding: 0;
        }
    }

    .logo {
        padding: 10px;
        text-align: center;

        img {
            padding: 5px;
            margin: auto;
            max-height: 60px;
            max-width: 100%;
            object-fit: contain;
        }
    }

    .nav-icon {
        font-size: 1.2em;
        @include media-breakpoint-up(md) {
            font-size: 1.5em;
        }
    }

    .func {
        justify-content: center;
        @include media-breakpoint-up(xl) {
            justify-content: end;
        }
    }

    .search {
        color: black;
        cursor: pointer;
        transition: 0.2s ease-out;
        
        &:hover {
            color: #ada587;
        }
    }

    .home {
        color: black;
        cursor: pointer;
        transition: 0.2s ease-out;
        
        &:hover {
            color: #ada587;
        }

        a {
            color: black;
            text-decoration: none;
            transition: 0.2s ease-out;
            
            &:hover {
                color: #ada587;
            }
        }
    }

    .sort {
        display: flex;
        align-items: center;
        padding: 10px 0;

        button {
            background: transparent;
            border: 0;
            color: black;
            font-size: 16px;
            @include media-breakpoint-up(md) {
                font-size: 19px;
            }
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            padding: 5px;

            span {
                transition: 0.2s ease-out;

                &:hover {
                    color: #ada587;
                }
            }
        }

        .active {
            transition: 0s;
            color: #ada587;
        }
    }
</style>