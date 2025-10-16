<script setup>
defineProps({
  message: {
    type: String,
    default: 'Произошла ошибка.' // Текст по умолчанию, если message не передан
  }
})
</script>

<template>
    <transition name="fade" mode="out-in">
        <div class="notification">
            {{ message }}
        </div>
    </transition>
</template>

<style lang="scss" scoped>
    .notification {
        width: 100%;
        font-family: 'Nunito', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: $text-light;
    }
</style>