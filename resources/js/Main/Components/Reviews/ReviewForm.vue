<script setup>
import { computed, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import StarRating from '@/Main/Components/Reviews/StarRating.vue';
import Notification from '@/Main/Components/Reviews/Notification.vue';

let submitted = ref(false);
let error = ref(false);
let errorMessage = ref('');
const form = useForm({
  comment: '',
  rating: 0,
  course: null // пока нет логики, но вообще должен получаться из select
  // сюда же нужно добавить user_id
});

const userCourses = ref([
    { id: 1, title: 'Полный курс по веб-разработке' },
    { id: 2, title: 'Vue 3 для начинающих' },
    { id: 3, title: 'Продвинутый курс по Figma' }
]);

// а еще можно менять плейсхолдер текстареа в зависимости от количества звезд, вроде звезд мало: "Что вам не понравилось?"

let commentLengthCounter = computed(() => {
    return form.comment.length;
});

let commentPlaceholder = computed(() => {
    switch (form.rating) {
        case 1:
            return 'Подскажите, как нам стать лучше?';
        case 2:
            return 'Что именно вам не понравилось?';
        case 3:
            return 'Что можно было бы улучшить?';
        case 4:
            return 'Спасибо за хорошую оценку! Что вам понравилось?';
        case 5:
            return 'Отлично! Расскажите, что вам понравилось больше всего?';
        default:
            return 'Что вы хотите рассказать о курсе?'; // Плейсхолдер по умолчанию
    }
});

const submit = () => {
    let showError = function (message) {
        error.value = true;
        errorMessage.value = message
        setTimeout(() => {
            error.value = false;
        }, 3000);
    }

    if (form.rating === 0) {
        showError('Пожалуйста, поставьте оценку от 1 до 5');
        return;
    }

    if (commentLengthCounter.value > 1000) {
        showError('Комментарий не должен превышать 1000 символов')
        return;
    }

    form.post('/reviews');
    submitted.value = true;
};

</script>

<template>
    <form @submit.prevent="submit">
        <span>Оставить отзыв:</span>
        <star-rating v-model="form.rating" />
        <div class="input-group select-wrapper mt-2 mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Курс</label>
            <select class="form-select" id="inputGroupSelect01" v-model="form.course" required :disabled="submitted">
                <option disabled :value="null">Выберите...</option>
                <option v-for="course in userCourses" :key="course.id" :value="course.title">{{ course.title }}</option>
            </select>
        </div>
        <div class="mb-3">
            <textarea v-model="form.comment" class="form-control review-textarea" rows="3" :placeholder="commentPlaceholder" required :disabled="submitted"></textarea>
            <small class="textarea-counter" :class="{'counter-limit': commentLengthCounter > 1000}">{{ commentLengthCounter }} / 1000</small>
        </div>
        <div class="send-form-button-wrap" href="#section-courses"><button type="submit" :disabled="submitted">Отправить отзыв</button></div>
        <Notification v-show="error" :message="errorMessage" />
    </form>
</template>

<style lang="scss" scoped>
    span {
        font-family: 'Inter';
        font-weight: 400;
        font-size: 18px;
        color: #23252C;
    }

    .send-form-button-wrap{
        width: 100%;
        display: flex;
        justify-content: left;

        button {
            margin: 20px 0 0 0;
            padding: 10px 20px;
            font-family: "Nunito", sans-serif;
            font-weight: 800;
            font-optical-sizing: auto;
            font-style: normal;
            font-size: clamp(14px, 2vw, 18px);
            color: white;
            background-color: #ADA587;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            
            &:hover {
                background-color: #8c8770;
            }
        }
    }

    .select-wrapper {
        select {
            border-radius: 5px;
        }

        .form-select,
        .input-group-text {
            background-color: transparent;
            color: #333;
            border-color: #D3C8B3;
            border-radius: 0.375rem;
        }

        .input-group-text {
            border-right: none;
        }
        .form-select {
            border-left: 1px solid #D3C8B3;
        }

        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(130, 115, 87, 0.25);
            border-color: #A89B85;
            background-color: transparent;
            color: #333;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }
    }

    .review-textarea {
        background-color: transparent;
        border-color: #D3C8B3;
        border-radius: 0.375rem;

        &:focus {
        box-shadow: 0 0 0 0.25rem rgba(130, 115, 87, 0.25);
        border-color: #A89B85;
        background-color: transparent;
        color: #333;
        }
    }

    .counter-limit {
        color: rgb(131, 0, 0);
    }
</style>