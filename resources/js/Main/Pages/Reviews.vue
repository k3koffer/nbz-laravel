<script setup>
import AppLayout from '@/Main/Layouts/AppLayout.vue';
import ReviewForm from '@/Main/Components/Reviews/ReviewForm.vue';
import Review from '@/Main/Components/Reviews/Review.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    reviews: Array,
    accept_reviews: Boolean,
});

</script>

<template>
    <AppLayout>
        <div class="index-body">
            <div class="go-back">
                <Link href="/">
                    <i class="fa-solid fa-rotate-left"></i>
                    На главную
                </Link>
            </div>
            <div class="reviews">
                <section class="top-text">
                    <h1>НеБойсяОтзывы</h1>
                    <p>Мы ценим отзывы о наших продуктах, ведь они помогают нам становиться лучше для вас. 
                        Ваше мнение — это важный ориентир в нашей работе, который позволяет нам совершенствовать наши товары и сервис.</p>
                    <p>Поделитесь своими впечатлениями, и вы поможете другим покупателям сделать правильный выбор. Расскажите, 
                        что вам понравилось, а что мы могли бы улучшить. Мы читаем каждый отзыв и стремимся учесть все ваши пожелания.</p>
                    <p>Оставить отзыв легко — просто заполните форму ниже. Спасибо, что помогаете нам расти!</p>
                </section>
                <section class="form-wrapper">
                    <review-form :accept_reviews="accept_reviews" />
                </section>
                <section class="reviews-list">
                    <review v-for="review in reviews" :key="review" :review="review" />
                </section>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="scss" scoped>
    .index-body {
        background-color: $bg-main;
    }

    .go-back {
        padding: 20px;
        font-family: 'Nunito', sans-serif;
        font-size: 16px;

        a {
        transition: 0.2s ease-out;
        text-decoration: none;
        color: $text-light;

        &:hover {
            color: #FF9F43;
        }
        }
    }

    .reviews {
        width: 100%;
        padding: 50px 5px;
        @include media-breakpoint-up(md) {
            width: 80%;
            padding: 100px 20px;
        }
        @include media-breakpoint-up(xl) {
            width: 50%;
        }
        margin: 0 auto;
    }

    .top-text {
        h1 {
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 32px;
            @include media-breakpoint-up(md) {
                font-size: 48px;
            }
            @include media-breakpoint-up(xl) {
                font-size: 64px;
            }
            text-align: center;
            color: $text-light;
        }

        p {
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 12px;
            @include media-breakpoint-up(md) {
                font-size: 13px;
            }
            @include media-breakpoint-up(xl) {
                font-size: 14px;
            }
            text-align: center;
            text-wrap: balance;
            color: $text-light;
        }
    }

    .form-wrapper {
        width: 100%;
        @include media-breakpoint-up(md) {
            width: 85%;
        }
        @include media-breakpoint-up(xl) {
            width: 70%;
        }
        margin: 0 auto;
        padding: 20px;
    }

    .reviews-list {
        width: 100%;
        @include media-breakpoint-up(md) {
            width: 85%;
        }
        @include media-breakpoint-up(xl) {
            width: 70%;
        }
        height: fit-content;
        margin: 0 auto;
        padding: 20px;
    }
</style>