<script setup>
import { ref, computed } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect'
import { useUiStore } from '@/Blog/Stores/ui';
import { storeToRefs } from 'pinia';

let uiStore = useUiStore();
let { isSearchVisible } = storeToRefs(uiStore);

let searchQuery = ref('');
let selectedTags = ref([]);

let tagOptions = [
    { id: 1, label: 'Новости' },
    { id: 2, label: 'Статья' },
    { id: 3, label: 'Интересный факт' },
    { id: 4, label: 'Топ' },
    { id: 5, label: 'Лайфхаки' },
]

// let tagOptions = [
//     'Новости',
//     'Статья',
//     'Интересный факт',
//     'Топ',
//     'Лайфхаки',
// ]

let performSearch = function () {
    if ((!searchQuery.value || searchQuery.value.length < 3) && (!selectedTags.value || selectedTags.value.length === 0)) {
        // change it to current notification system
        alert('Введите не менее 3 символов или выберите теги');
        return;
    }

    let tagIds = selectedTags.value.map(tag => tag.id);

    router.get(
        '/',
        {
            search: searchQuery.value,
            tags: tagIds,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            only: ['posts'],
        }
    );
}

let haveInput = computed(() => {
    if (searchQuery.value.length === 0) {
        return false;
    } else {
        return true;
    }
});

let clearInput = function () {
    searchQuery.value = '';
}

let showResetButton = computed(() => {
    const getQueryParam = (paramName) => {
        const searchParams = new URLSearchParams(window.location.search);
        return searchParams.get(paramName);
    };

    if (getQueryParam('sort') == null && getQueryParam('search') == null) {
        return false;
    } else {
        return true;
    }
});

</script>

<template>
        <transition name="slide-fade"> 
            <div class="search-popup-container" v-if="isSearchVisible">
                <form class="search-popup-content row" @submit.prevent="performSearch">
                    <div class="input-wrapper col-12">
                        <input v-model="searchQuery" :class="{'py-2': haveInput}" type="text" class="form-control" placeholder="Поиск..." spellcheck="false">
                        <transition name="fade" mode="out-in">    
                            <button v-show="haveInput" @click.prevent="clearInput" class="clear-input">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </transition>
                        <button class="form-submit" type="submit">
                            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                        </button>
                    </div>
                    <div class="col-12 mt-3 multiselect-wrapper">
                        <multiselect name="tags" :options="tagOptions" placeholder="Выберите теги..." v-model="selectedTags" label="label" track-by="id" :taggable="true" :multiple="true" />
                    </div>
                    <Link v-if="showResetButton" class="reset-query-button" href="/">Сбросить результат</Link>
                </form>
            </div>
        </transition>
</template>

<style lang="scss" scoped>
    .search-popup-container {
        width: 100%;

        @include media-breakpoint-up(lg) {
            width: 80%;
        }

        @include media-breakpoint-up(lg) {
            width: 60%;
        }

        @include media-breakpoint-up(xl) {
            width: 40%;
        }
    }

    .search-popup-content {
        width: 100%;
        margin: 0 auto;
        padding: 10px 5px;
        @include media-breakpoint-up(lg) {
            padding: 30px;
        }
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-self: center;

        .form-submit {
            i {
                transition: 0.2s ease-out;
                color: #D3C8B3;
            }

            &:hover {
                i {
                    transform: rotateY(180deg);
                }
            }
        }

        .input-wrapper {
            display: inline-flex;
            position: relative;

            .clear-input {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 40px;
                padding: 0 5px;
                color: #D3C8B3;
            }

            input {
                background-color: transparent;
                border: 0;
                border-bottom: solid 2px;
                border-color: #D3C8B3;
                font-family: 'Nunito', sans-serif;
                font-family: 18px;
                padding: 5px;
                transition: 0.2s ease-in;
    
                &::placeholder {
                    font-family: 'Nunito', sans-serif;
                    font-size: 18px;
                    letter-spacing: 1px;
                }
    
                &:focus {
                    box-shadow: unset;
                }

                &:focus-visible {
                    outline: 0;
                }
            }
        }

        .reset-query-button {
            font-family: 'Nunito', sans-serif;
            font-family: 18px;
            width: fit-content;
            padding: 10px 20px;
            transition: 0.2s ease-in;
            color: #23252C;

            &:hover {
                transform: scale(1.05);
            }
        }

        .multiselect-wrapper {
            &:deep(.multiselect__tags) {
                background: transparent;
                border: 0;
                border-bottom: solid 2px;
                border-color: #D3C8B3;
                border-radius: 0;
            }

            &:deep(.multiselect__placeholder) {
                font-family: 'Nunito', sans-serif;
                font-size: 18px;
                color: $input-placeholder-color;
                letter-spacing: 1px;
                margin-bottom: 5px;
            }

            &:deep(.multiselect__content-wrapper) {
                background: #F8F6F0;
            }

            &:deep(.multiselect__option--highlight) {
                background: #D3C8B3;
            }

            &:deep(.multiselect__option--selected) {
                background: #F8F6F0;
                color: #35495e;
                font-weight: bold;
            }

            &:deep(.multiselect__single) {
                background: transparent;
                font-family: 'Nunito', sans-serif;
                font-size: 16px;
                color: $input-placeholder-color;
                font-weight: 600;
                letter-spacing: 1px;
            }

            &:deep(.multiselect__option--selected::after) {
                color: #35495e;
            }

            &:deep(.multiselect__option--highlight::after) {
                display: none;
            }

            &:deep(.multiselect__tag) {
                background-color: #FBEEC1;
                color: #23252C;
            }

            &:deep(.multiselect__tag-icon) {
                &::after {
                    color: #23252C;
                }

                &:hover{
                    &::after {
                        color: rgb(158, 158, 158);
                    }
                }
            }

            &:deep(input) {
                background-color: transparent;
                border: 0;
                outline-offset: 0;
                box-shadow: unset;
                font-family: 'Nunito', sans-serif;
                font-size: 16px;
                color: $input-placeholder-color;
                letter-spacing: 1px;
            }
        }
    }
</style>