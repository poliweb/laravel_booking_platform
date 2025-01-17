<template>
    <header class="bg-gray-50 text-black/50 dark:border-gray-700 dark:bg-gray-800 dark:text-white/50 hidden md:block">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
                <Link :href="route('home')" :class="['noActive', { 'Active': $page.component === 'Home' }]"
                    class="mr-5 ">Главная</Link>
                <Link :href="route('about')" :class="['noActive', { 'Active': $page.component === 'About' }]"
                    class="mr-5">О нас</Link>
                <Link :href="route('posts.index')" :class="['noActive', { 'Active': $page.url.startsWith('/posts') }]" class="mr-5">Посты</Link>
                <a class="hover:text-gray-900">Fourth Link</a>
            </nav>
            <div class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0">
                <ApplicationLogo class="h-8 w-auto text-white lg:h-16 lg:text-[#FF2D20] fill-[#fff]" />
            </div>

            <div v-if="canLogin" class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
                <template v-if="$page.props.auth.user">
                    <Link :href="route('dashboard')"
                        class="flex items-center gap-2 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-pink-500">
                        <Icon icon="guidance:office-pod" class="w-5 h-5" /> Личный кабинет
                    </Link>

                    <Link :href="route('logout')" method="post" class="flex items-center gap-2"><Icon icon="guidance:emergency-exit" class="w-5 h-5" /> Выйти </Link>
                </template>
                <template v-else>
                    <Link :href="route('login')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-pink-500">
                    Войти
                    </Link>

                    <Link v-if="canRegister" :href="route('register')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-pink-500">
                    Регистрация
                    </Link>
                </template>
            </div>
        </div>
    </header>
    <!-- Responsive Header -->
    <header
        class="bg-gray-50 text-black/50 dark:border-gray-700 dark:bg-gray-800 dark:text-white/50 flex md:hidden relative">
        <div class="container mx-auto flex px-4 h-16 flex-row items-center justify-between border-b border-gray-200 dark:border-gray-600">
            <Link @click="close" :href="route('home')"
                class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-0">
            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </Link>

            <!-- Hamburger -->
            <button @click="mobileMenu = !mobileMenu" class="flex md:hidden">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{
                        hidden: mobileMenu,
                        'inline-flex':
                            !mobileMenu,
                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{
                        hidden: !mobileMenu,
                        'inline-flex':
                            mobileMenu,
                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Responsive Navigation Menu -->
        <div :class="{ block: mobileMenu, hidden: !mobileMenu }"
            class="md:hidden absolute top-[100%] left-0 right-0 min-h-24 overscroll-y-auto bg-gray-50 text-black/50 dark:border-gray-700 dark:bg-gray-800 dark:text-white/50">
            <div class="container mx-auto">
            <ul class="mx-0 border-b border-gray-200 px-3 py-4 dark:border-gray-600">
                <li>
                    <ResponsiveNavLink @click="close" :href="route('home')"
                        :class="['noActive', { 'Active': $page.component === 'Home' }]"
                        class="mr-5">Главная
                    </ResponsiveNavLink>
                </li>
                <li>
                    <ResponsiveNavLink @click="close" :href="route('about')"
                        :class="['noActive', { 'Active': $page.component === 'About' }]"
                        class="mr-5">О нас
                    </ResponsiveNavLink>
                </li>
                <li>
                    <ResponsiveNavLink @click="close" :href="route('posts.index')"
                        :class="['noActive', { 'Active': $page.url.startsWith('/posts') }]"
                        class="mr-5">
                        Посты
                    </ResponsiveNavLink>
                </li>
            </ul>

            <div v-if="canLogin"
                class="w-full flex flex-col justify-end mx-0 border-b border-gray-200 pb-1 pt-4 dark:border-gray-600">
                <template v-if="$page.props.auth.user">
                    <div class="px-4 mb-4">
                        <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>
                    <ResponsiveNavLink @click="close" :href="route('dashboard')">
                        Личный кабинет
                    </ResponsiveNavLink>

                    <ResponsiveNavLink @click="close" :href="route('logout')" method="post">
                        Выйти
                    </ResponsiveNavLink>
                </template>
                <template v-else>
                    <ResponsiveNavLink :href="route('login')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-pink-500">
                        Войти
                    </ResponsiveNavLink>

                    <ResponsiveNavLink v-if="canRegister" :href="route('register')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-pink-500">
                        Регистрация
                    </ResponsiveNavLink>
                </template>
            </div>
        </div>
        </div>
    </header>
</template>

<script setup>
import { ref } from 'vue';
import { Icon } from "@iconify/vue";
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';




const mobileMenu = ref(false)

const close = () => {
    mobileMenu.value = false
}


defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<style scoped>
.noActive {
    @apply hover:text-pink-500 dark:text-gray-300 dark:hover:text-pink-500/80;
}

.Active {
    @apply text-pink-500 font-bold hover:text-pink-500;
}
</style>
