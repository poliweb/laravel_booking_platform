<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <Header :canLogin="true" :canRegister="true" />
        <transition name="fade" mode="out-in">
            <main :key="$page.component">
                <FlashMessage />
                <slot />
            </main>
        </transition>
        <Footer />
    </div>
</template>

<script setup>
import Header from '../Components/Header.vue';
import Footer from '../Components/Footer.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { usePage } from '@inertiajs/vue3';

const props = usePage().props;
const canLogin = props.auth.user === null; // Если пользователь не авторизован
const canRegister = props.canRegister || true; // Проверьте доступность регистрации

</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: scale(0.8);
    /* filter: blur(16px); */
}
</style>
