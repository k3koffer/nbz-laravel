<script setup>
import { defineProps, defineEmits } from 'vue';
// Определяем props, которые компонент принимает
const props = defineProps({
  modelValue: {
    type: Number,
    required: true,
  },
  maxStars: {
    type: Number,
    default: 5,
  },
});

// Определяем события, которые компонент может отправлять
const emit = defineEmits(['update:modelValue']);

// Функция для обновления рейтинга
const rate = (star) => {
  emit('update:modelValue', star);
};
</script>
<template>
    <div class="rating-wrapper mx-3">
        <div v-for="star in maxStars" :key="star" @click="rate(star)" class="rating-star" :class="{ 'active-star': star <= modelValue }">
            <i class="fa-solid fa-star"></i>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .rating-wrapper {
        width: fit-content;
        display: inline-block;
        transition: 0.2s;

        .rating-star {
            display: inline;
            cursor: pointer;
            color: #ccc; /* Начальный цвет для неактивных звезд */
            transition: transform 0.2s ease-in-out, color 0.2s ease-in-out; /* Плавные переходы для цвета и размера */
            display: inline-block;
        }

        .active-star {
            color: rgb(228, 199, 70);
        }

        &:hover {
            transform: scale(1.2);
        }
    }

    .rating-wrapper:hover .rating-star {
        color: rgb(255, 221, 87);
    }

    .rating-wrapper .rating-star:hover ~ .rating-star {
        color: #ccc; /* Или любой другой цвет по умолчанию */
    }
</style>