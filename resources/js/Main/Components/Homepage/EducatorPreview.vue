<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        educator: {
            type: Object,
            required: true
        }
    })

    let imageLink = computed(() => {
        let imageURL = `https://ik.imagekit.io/3dwnck0ax/tr:w-1024,h-1024/${props.educator.picture}`;
        return {
            backgroundImage: `url(${imageURL})`
        }
    })
</script>

<template>
    <div class="col-4 px-0 mx-0 educator-preview">
        <div :style="imageLink" class="image mx-auto"></div>
        <h3>{{ educator.name }}</h3>
        <p>{{ educator.bio }}</p>
    </div>
</template>

<style lang="scss" scoped>
    .col-4 {
        padding: 20px 0;
        min-height: 500px;
        min-width: fit-content;
        @include media-breakpoint-up(md) {
            min-width: 440px;
        }
    }

    .image {
        width: clamp(200px, 15vw,300px);
        height: clamp(200px, 15vw,300px);
        border-radius: 50%;
        background: gray;
        background-size: cover;
        background-repeat: no-repeat;
        transition: 0.5s;

        &:hover {
            transform: scale(1.05);
        }
    }

    h3 {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: clamp(30px, 2vw, 40px);
        letter-spacing: -0.02em;
        color: #F8F6F0;
        text-align: center;
        padding: 40px 5px 5px 5px;
    }

    p {
        font-family: 'Inter', sans-serif;
        font-weight: 400;
        font-size: clamp(16px, 1vw, 20px);
        letter-spacing: -0.02em;
        text-align: center;
        color: #F8F6F0;
        min-height: 108px;
        height: fit-content;
        padding: 0 30px;
    }
</style>