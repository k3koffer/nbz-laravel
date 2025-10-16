<script setup>
import { Link } from '@inertiajs/vue3';

let links = [
    { name: 'Главная', href: '/' },
    { name: 'О нас', href: '/about' },
    { name: 'Отзывы', href: '/reviews' },
];


</script>

<template>
    <header class="row mx-0">
        <div class="mx-0 px-0 col-12 col-lg-4">
            <Link href='/'>
                <div class="logo"><img alt="Логотип НеБойсяЗнать" src="https://ik.imagekit.io/3dwnck0ax/new_logo_transparent.webp?updatedAt=1760216006474"></div>
            </Link>
        </div>
        <nav class="mx-0 px-0 py-3 col-12 col-lg-8 d-flex nav-menu">
            <ul class="mx-0 px-0 row w-100">
                <li class="col px-0" v-for="link in links" :key="link.href">
                    <Link :href="link.href">{{ link.name }}</Link>
                </li>
                <li class="col">
                    <a href="/blog">Блог</a>
                </li>
            </ul>
        </nav>
    </header>

</template>

<style lang="scss" scoped>
    header {
        background-color: $bg-white;
    }

    .logo {
        padding: 10px;
        text-align: center;

        img {
            margin: auto;
            max-height: 60px;
            max-width: 100%;
            object-fit: contain;
        }
    }

    .nav-menu {

        li {
            text-align: center;
            max-width: 150px;
            height: fit-content;
    
            
            transition: 0.2s ease-out;
            
            
            a {
                font-size: clamp(14px, 2vw, 18px);
                font-family: "Nunito", sans-serif;
                font-weight: 800;
                font-optical-sizing: auto;
                font-style: normal;
                text-decoration: none;
                color: $text-light;
                
                padding: 10px;

                &:hover {
                    color: $dark-text-hover;
                    transition: 0.2s ease-in;
                }
            }
        }

        ul {
            justify-content: center;
            @include media-breakpoint-up(lg) {
                justify-content: flex-end;
            }
            align-items: center;
            margin: 0;
        }
    }
</style>