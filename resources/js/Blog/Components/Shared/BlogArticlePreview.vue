<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

let props = defineProps({
    article: Object,
    size: Number
});

let articleSize = computed(() => {
    switch (props.size) {
        case 1:
            return 'article-big';
        case 2:
            return 'article-medium';
        default:
            return 'article-small';
    }
});

let attributeShow = computed(() => {
    switch (props.size) {
        case 1:
            return false;
        case 2:
            return false;
        default:
            return true;
    }
});

let articleType = computed(() => {
    switch (props.article.type) {
        case 2:
            return "ПОДКАСТ";
        case 3:
            return "ВИДЕО";
        default:
            return "СТАТЬЯ";
    }
});

let articlePicture = computed(() => {
    let picture = JSON.parse(props.article.picture);
    if (picture && picture.path) {
        return 'url(https://ik.imagekit.io/3dwnck0ax' + picture.path +')';
    } else {
        return 'unset';
    }
});

let articleLink = computed(() => {
    return '/posts/' + props.article.link
});
</script>

<template>
    <Link :href="articleLink" class="text-decoration-none">
        <div class="article-overlay">
            <div :style="{ backgroundImage: articlePicture }" class="article" :class="articleSize">
                <div v-if="!attributeShow" class="px-2 article-attribute">
                        <p class="article-type">{{ articleType }}</p>
                        <h3><strong>{{ props.article.title }}</strong> {{ props.article.description }}</h3>
                </div>
            </div>
            <div v-if="attributeShow" class="px-2 article-attribute">
                <p class="article-type">{{ articleType }}</p>
                <h3><strong>{{ props.article.title }}.</strong> {{ props.article.description }}</h3>
            </div>
        </div>
    </Link>
</template>

<style lang="scss" scoped>
    .article-overlay {
        border-radius: 8px;

        margin: 0;
        @include media-breakpoint-up(md) {
            margin: 0 20px;
        }

        cursor: pointer;
        transition: 0.3s;
        background-size: cover;
        background-repeat: no-repeat;

        &:hover {
            transform: scale(0.99);

            .article:hover::before {
                background: rgba(0, 0, 0, 0.2); /* Затемнение при наведении */
            }
            .article-attribute {
                transform: scale(1.03);
            }
        }

        .article-attribute {
            transition: 0.3s;
            .article-type {
                font-size: 13px;
                color: rgb(172, 172, 172);
                margin: 10px 0;
                letter-spacing: 1px;
                font-family: 'Montserrat', sans-serif;
                font-weight: 500;
            }

            h3 {
                font-size: 18px;
                color: #23252C;
                margin: 10px 0;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
                text-align: unset;
            }

            .article-description {
                font-size: 15px;
                color: #23252C;
                margin: 10px 0;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
            }
        }

    }

    .article-big {
        min-height: 240px;
        display: flex;
        align-items: end;

        @include media-breakpoint-up(lg) {
            min-height: 600px;
        }

        .article-attribute {
            width: 100%;

            @include media-breakpoint-up(lg) {
                width: 50%;
            }
            
            margin: 20px 40px;
            z-index: 2;

            .article-type {
                font-size: 13px;
                color: rgb(197, 197, 197);
                margin: 10px 0;
                letter-spacing: 1px;
                font-family: 'Montserrat', sans-serif;
                font-weight: 500;
                padding: 0 10px;
            }

            h3 {
                font-size: clamp(16px, 2vw, 20px);
                color: white;
                margin: 10px 0;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
                text-align: unset;
                padding: 0 10px;
                line-height: 20px;
                
                @include media-breakpoint-up(lg) {
                    line-height: 30px;
                }
            }

            .article-description {
                font-size: 15px;
                color: white;
                margin: 10px 0;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
            }
        }
    }

    .article-medium {
        min-height: 240px;
        display: flex;
        align-items: end;
        
        @include media-breakpoint-up(lg) {
            min-height: 400px;
        }

        .article-attribute {
            width: 90%;
            margin: 20px auto;
            z-index: 2;

            .article-type {
                font-size: 13px;
                color: rgb(197, 197, 197);
                margin: 10px 0;
                letter-spacing: 1px;
                font-family: 'Montserrat', sans-serif;
                font-weight: 500;
                padding: 0 10px;
            }

            h3 {
                font-size: clamp(16px, 2vw, 20px);
                color: white;
                margin: 10px 0;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
                text-align: unset;
                padding: 0 10px;
                line-height: 20px;
                
                @include media-breakpoint-up(lg) {
                    line-height: 30px;
                }
            }

            .article-description {
                font-size: 15px;
                color: white;
                margin: 10px 0;
                font-family: 'Montserrat', sans-serif;
                font-weight: 400;
            }
        }
    }

    .article-small {
        min-height: 240px;
    }

    .article {
        position: relative;
        padding: 25px 0 0 0;
        height: 100%;
        background: rgba(11, 7, 4, 0.67);
        border-radius: 8px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        background-size: cover;
        background-repeat: no-repeat;

        &::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0); /* Прозрачный фон по умолчанию */
            transition: background 0.3s ease; /* Плавное затемнение */
            pointer-events: none; /* Чтобы не мешать кликам */
        }

        &::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* 50% затемнение */
            pointer-events: none;
            border-radius: 8px;
        }

        h3 {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 28px;
            letter-spacing: -0.02em;
            color: #fff;
            text-align: center;
            // width: 100%;
            padding: 0 20px;
        }

        h5 {
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            font-style: italic;
            font-size: 15px;
            letter-spacing: -0.02em;
            text-align: center;
            color: #e2e2e2;
            text-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
            max-width: 350px;
            margin: 0 auto;
            width: 100%;
        }

        .picture {
            width: 30px;
            height: 30px;
            background-color: #d9d9d9;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .picture-wrap {
            display: flex;
            justify-content: center;
            align-content: center;
            flex-wrap: wrap;
        }

        .article-educator {
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            font-size: 15px;
            letter-spacing: -0.02em;
            text-align: center;
            color: #e2e2e2;
            text-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
            line-height: 2;
            padding: 0 10px;
        }

        .article-length {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: -0.02em;
            text-align: center;
            color: #e2e2e2;
            text-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
            line-height: 2;
            padding: 0 10px;
            position: absolute;
            right: 0;
        }
    }
</style>