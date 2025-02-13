<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({ user: Object })



</script>

<template>

    <Head title="Личный кабинет" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ $page.props.auth?.user.name }} Ваш личный кабинет клиента
            </h2>
            <h3 class="text-sm text-gray-600 dark:text-gray-400">Ваш статус:
                {{
                    $page.props.auth?.user?.role === 'client' ? 'Клиент' :
                        $page.props.auth?.user?.role === 'master' ? 'Мастер' :
                            $page.props.auth?.user?.role === 'admin' ? 'Администратор' : user?.role
                }}

            </h3>
        </template>

        <div class="py-12">
            <div class="container mx-auto px-4 sm:px-5">
                <div class="overflow-hidden bg-white shadow-xs sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
