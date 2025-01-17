<template>
    <div v-if="visible && (flash.success || flash.error)" class="flash-message">
        <div v-if="flash.success" class="flash flash-success">
            <Icon icon="carbon:close-filled" @click="hideFlash"
                class="w-6 h-6 ml-auto cursor-pointer mb-6 hover:text-gray-300" />
            {{ flash.success }}
        </div>
        <div v-if="flash.error" class="flash flash-error">
            <Icon icon="carbon:close-filled" @click="hideFlash"
                class="w-6 h-6 ml-auto cursor-pointer mb-6 hover:text-gray-300" />
            {{ flash.error }}
        </div>
    </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { ref, watch, onBeforeUnmount } from "vue";

// Получаем flash-сообщения из props
const { flash } = usePage().props;

// Переменные для состояния
const visible = ref(false);
let timeoutId = null;

// Функция для показа flash-сообщения
const showFlash = () => {
    visible.value = true;

    // Сбрасываем предыдущий таймер, если есть
    if (timeoutId) {
        clearTimeout(timeoutId);
    }
    // Устанавливаем таймер на 3 секунды
    timeoutId = setTimeout(hideFlash, 7000);
};

// Функция для скрытия flash-сообщения
const hideFlash = () => {
    visible.value = false;
    if (timeoutId) {
        clearTimeout(timeoutId);
        timeoutId = null;
    }
};

// Следим за изменениями flash-сообщений
watch(
    () => flash,
    () => {
        if (flash.success || flash.error) {
            showFlash();
        }
    },
    { immediate: true } // Сразу обрабатываем существующее сообщение
);

// Очистка таймера при демонтаже компонента
onBeforeUnmount(() => {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }
});
</script>

<style>
.flash-message {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 1000;
    gap: 0.5rem;
}

.flash {
    padding: 1rem 1.5rem;
    border-radius: 0.375rem;
    font-size: 1rem;
    color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.flash-success {
    background-color: #38a169;
    /* Зеленый */
}

.flash-error {
    background-color: #e53e3e;
    /* Красный */
}

.flash .w-6 {
    margin-left: auto;
    cursor: pointer;
}
</style>
