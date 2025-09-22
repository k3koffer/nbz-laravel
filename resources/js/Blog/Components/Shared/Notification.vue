<script setup>
import { ref, watch, onMounted ,onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import emitter from '@/eventBus.js';

const page = usePage();

const notificationMessage = ref(null);
const notificationType = ref(null); 

let notificationTimer = null;

const hideNotification = () => {
  notificationMessage.value = null;
  clearTimeout(notificationTimer);
};

const showNotification = (message, type) => {
  notificationMessage.value = message;
  notificationType.value = type;

  clearTimeout(notificationTimer);
  
  notificationTimer = setTimeout(() => {
    hideNotification();
  }, 3000);
};

watch(() => page.props.flash.success, (newMessage) => {
  if (newMessage) {
    showNotification(newMessage, 'success');
  }
});

watch(() => page.props.flash.error, (newMessage) => {
  if (newMessage) {
    showNotification(newMessage, 'error');
  }
});

onMounted(() => {
  emitter.on('show-notification', (data) => {
    showNotification(data.message, data.type);
  });
});

onUnmounted(() => {
  emitter.off('show-notification'); // Отписываемся от события при уничтожении компонента
  clearTimeout(notificationTimer);
});

</script>

<template>
    <TransitionGroup name="fade" tag="div" class="notification-container">
        <div 
            v-if="notificationMessage" 
            :key="notificationType" 
            :class="['notification', `is-${notificationType}`]"
        >
            <i :class="['icon', notificationType === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle']"></i>
            
            <span>{{ notificationMessage }}</span>

            <button @click="hideNotification" class="close-button">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </TransitionGroup>
</template>

<style lang="scss" scoped>
    .notification-container {
        position: fixed;
        bottom: 20px;  
        right: 20px;    
        width: auto;   
        z-index: 1000; 
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .notification {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-size: 1rem;
        color: #343A40;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: 2px solid transparent;
        max-width: 350px;
        width: auto;
    }

    .icon {
        margin-right: 0.75rem;
        font-size: 1.2em;
    }

    .notification.is-success {
        background-color: #FF9F43;
        border-color: #e68a2e;
        color: #ffffff;
    }

    .notification.is-danger {
        background-color: #E76F51;
        border-color: #d15a3a;
        color: #ffffff;
    }

    .close-button {
        margin-left: auto;
        padding-left: 1rem;
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }

    .close-button:hover {
        opacity: 1;
    }
</style>