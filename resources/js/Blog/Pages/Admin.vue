<script setup>
import AppLayout from '@/Blog/Layouts/AppLayout.vue';
import ArticlePreview from '@/Blog/Components/Admin/ArticlePreview.vue';
import { ref, onMounted, computed, defineAsyncComponent } from 'vue';
import { router, useForm, Head } from '@inertiajs/vue3';
import { Modal } from 'bootstrap';
import 'md-editor-v3/lib/style.css';
import { ARTICLE_TYPES } from '@/constants.js';

const MdEditor = defineAsyncComponent(() => 
    import('md-editor-v3').then(mod => mod.MdEditor)
);

let props = defineProps({
    posts: Object,
    educators: Array,
});

let postModalElement = ref(null);
let postModal = ref(null);

// теги в форме

let formPicture = ref();

let form = useForm({
    id: null,
    title: '',
    description: '',
    picture: null,
    type: null,
    creator_id: null,
    tags: null,
    content: 'Текст статьи не установлен.',
});

const submit = () => {
    if (form.id) {
        router.post(route('posts.update', form.id), {
            _method: 'put',
            title: form.title,
            description: form.description,
            picture: form.picture,
            type: form.type,
            creator_id: form.creator_id,
            content: form.content,
            tags: form.tags,
        }, {
            onSuccess: () => closeModal(),
            forceFormData: true,
        });
    } else {
        form.post(route('posts.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

let previousPicture = ref(null);
let openEditModal = function (post) {
    form.reset();

    form.id = post.id;
    form.title = post.title;
    form.description = post.description;
    form.type = post.type;
    form.creator_id = post.creator_id;
    form.tags = post.tags;
    form.content = post.content;
    
    form.picture = null;

    let previousPicturePath = JSON.parse(post.picture);
    if (previousPicturePath && previousPicturePath.path) {
        previousPicture.value = previousPicturePath.path;
    } else {
        previousPicture.value = 'не установлена';
    }

    openModal();
};

let openCreateModal = function () {
    openModal();
}

onMounted(() => {
    if (postModalElement.value) {
        postModal.value = new Modal(postModalElement.value);
    }
});

const openModal = () => {
    if (postModal.value) {
        postModal.value.show();
    }
};

const closeModal = () => {
     if (postModal.value) {
        postModal.value.hide();
        form.reset();
        previousPicture.value = null;
        if (formPicture.value) {
            formPicture.value.value = '';
        }
    }
};
</script>

<template>
    <Head title="Панель администратора (блог)" />

    <AppLayout>
            <transition name="fade" mode="out-in">
                <div class="admin-menu">
                    <div class="modal fade" ref="postModalElement" id="blogModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="blogModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <form @submit.prevent="submit" id="modalForm">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="blogModalLabel">{{ form.id ? 'Обновить' : 'Создать' }} статью</h1>
                                        <button @click="closeModal" type="button" class="btn-close" aria-label="Закрыть"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input id="articleId" type="text" class="d-none">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">title</span>
                                                    <input v-model="form.title" required name="title" type="text" class="form-control" placeholder="Название статьи (60 символов max)" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon2">desc</span>
                                                    <input v-model="form.description" name="description" type="text" class="form-control" placeholder="Описание статьи (160 символов max)" aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon3">pic</span>
                                                    <input ref="formPicture" @input="form.picture = $event.target.files[0]" name="picture" type="file" class="form-control" placeholder="Вставьте картинку" aria-describedby="basic-addon3">
                                                </div>
                                                <div class="mb-3">
                                                    <span style="color: gray; font-size: 14px;">(1200x630 или соотв.)</span>
                                                    <span v-show="previousPicture !== null" style="color: black; font-size: 14px;"> пред. <strong>{{ previousPicture }}</strong></span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <select v-model="form.type" name="type" id="articleTypesSelect" class="form-select" >
                                                    <option value="null" selected disabled>Выберите тип</option>
                                                    <option v-for="(value, key) in ARTICLE_TYPES" :key="key" :value="key">{{ value }}</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <select v-model="form.creator_id" name="creator" id="articleCreatorSelect" class="form-select">
                                                    <option value="null" selected disabled>Выберите создателя</option>
                                                    <option v-for="educator in educators" :key="educator.id" :value="educator.id">{{ educator.name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- md editor -->
                                        <MdEditor style="min-height: 500px" v-model="form.content" />
                                    </div>
                                    <div class="modal-footer">
                                        <button @click="closeModal" type="button" class="btn btn-dark decline-button">Отменить</button>
                                        <button type="submit" class="btn btn-success actModalButton">{{ form.id ? 'Обновить' : 'Добавить' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <h1 class="title">Кабинет администратора</h1>
                    <section class="blog">
                        <div class="section-description-wrap">
                            <h2 class="section-description">Управление блогом</h2>
                            <button @click="openCreateModal" class="btn btn-light mx-3 my-3"><i class="fa-solid fa-plus" aria-hidden="true"></i></button>
                        </div>
                        <div class="article-list row">
                            <div class="col-4" v-for="post in posts.data">
                                <ArticlePreview @edit="openEditModal($event)" :data="post" :key="post.id" />
                            </div>
                        </div>
                    </section>
                </div>
            </transition>
    </AppLayout>
</template>

<style lang="scss" scoped>
    .admin-menu {
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

    .title {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 24px;
        text-align: center;
        padding: 20px;
        
        @include media-breakpoint-up(md) {
            padding: 5px;
            font-size: 40px;
            text-align: unset;
        }

        letter-spacing: -0.02em;
        color: #232323;
        margin: 0;
    }

    .section-description-wrap {
        display: inline-flex;
        align-items: center;
    }

    .courses-list {
        display: flex;
        justify-content: center;
    }

    .article-list {
        width: 100%;
        justify-content: center;
    }
</style>