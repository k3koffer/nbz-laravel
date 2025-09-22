<script setup>
import { computed, ref } from 'vue';
const props = defineProps({
  review: {
    type: Object,
    required: true,
  },
});
</script>

<template>
    <figure>
        <div class="top">
            <span class="reviewer">{{ review.user_name }}</span>
            <div class="stars">
                <div v-for="star in review.rating" :key="star" class="rating-star active-star">
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>
        <span class="course">{{ review.course }}</span>
        <p>{{ review.comment }}</p>
        <figcaption>{{ review.created_at_formatted }}</figcaption>
    </figure>
</template>

<style lang="scss" scoped>
    figure {
        padding: 20px 10px 10px 10px;
        background-color: transparent;
        border: 1px solid #D3C8B3;
        border-top: 0;
        border-right: 0;
        border-left: 0;
    }

    p {
        font-family: 'Nunito', sans-serif;
        font-weight: 400;
        font-size: 16px;
        padding: 10px 0;
    }

    .top {
        display: flex;
        justify-content: space-between;

        .reviewer {
            font-family: 'Nunito', sans-serif;
            font-weight: 500;
            font-size: 18px;
            padding-right: 10px;
        }
    
        .rating-star {
            display: inline;
            color: #ccc;
            display: inline-block;
        }
    
        .active-star {
            color: rgb(228, 199, 70);
        }
    }

    .course {
        font-family: 'Nunito', sans-serif;
        font-weight: 400;
        font-size: 14px;
    }

    figcaption {
        padding-top: 20px;
        font-family: 'Nunito', sans-serif;
        font-weight: 400;
        font-size: 14px;
        color: #636363;
    }
</style>