<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import emitter from '@/eventBus.js';

const showNotification = (message, type = 'success') => {
    emitter.emit('show-notification', { message, type });
}

let props = defineProps({
    data: Object,
});

let emit = defineEmits(['edit']);

let handleEditClick = function () {
    emit('edit', props.data);
};

let isDeleteConfirmShowed = ref(false);
let isActionButtonsShowed = ref(false);

let toggleActionButtons = function () {
    isActionButtonsShowed.value = !isActionButtonsShowed.value;

    if (isDeleteConfirmShowed.value === true) {
        isDeleteConfirmShowed.value = !isDeleteConfirmShowed.value;
    }
};

let postId = props.data.id

let showModal = function () {

};

let deletePost = function () {
    router.delete(`/admin/posts/${postId}`, {
        preserveScroll: true,
        onSuccess: () => {
            isDeleteConfirmShowed.value = false;
            showNotification('Пост был успешно удалён!', 'success')
        },
        onError: (errors) => {
            showNotification('Произошла ошибка при удалении поста', 'danger')
            console.error('Ошибка при удалении поста:', errors);
        }
    });
};

</script>

<template>
    <div class="article row">
        <button @click="toggleActionButtons" class="show-actions-button"><i class="show-actions-icon fa-solid fa-eye"></i></button>
        <div class="col-12 span-wrap"><span class="title span-info">{{ data.title }}</span></div>
        <div class="col-12 span-wrap"><span class="time span-info">{{ data.created_at }}</span></div>
        <transition name="slide-fade"> 
            <div v-show="isActionButtonsShowed" class="actions">
                <button @click="isDeleteConfirmShowed = !isDeleteConfirmShowed" class="action-button delete-button">Удалить</button>
                <button @click="handleEditClick" class="action-button change-button">Изменить</button>
            </div>
        </transition>
        <transition name="slide-fade"> 
            <div v-show="isDeleteConfirmShowed" class="delete-confirm">
                <span class="span-info">Вы точно хотите удалить этот материал?</span>
                <button @click="deletePost" class="delete-confirm-button">Подтверждаю</button>
            </div>
        </transition>
    </div>
</template>

<style lang="scss" scoped>
    .article {
        background-color: $dark-bg-light;
        border-radius: 10px;
        margin: 10px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        padding: 10px;
    }

    .show-actions-button {
        background-color: transparent;
        border: 0;
        color: $bg-creme;
        width: fit-content;

        .show-actions-icon {
            transition: 0.2s;
        }

        &:hover {
            .actions-icon {
                transform: scale(1.1);
            }
        }
    }
    
    .span-wrap {
        text-align: center;
    }

    .span-info {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 14px;
        color: $bg-creme;
    }
    
    .time {
        font-size: 12px;
        color: $dark-text-meta;
    }

    .actions {
        justify-content: center;
        display: inline-flex;
    }

    .action-button {
        margin: 10px;
        border: 0;
        background-color: $text-meta;
        padding: 5px 10px;
        border-radius: 10px;

        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 12px;
        color: $bg-creme;
    }

    .delete-confirm {
        text-align: center;
    }

    .delete-confirm-button {
        margin: 10px;
        border: 0;
        background-color: #8c6f6b;
        padding: 5px 10px;
        border-radius: 10px;

        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 12px;
        color: $bg-creme;
    }
</style>