<!-- Admin/Users/Index.vue -->

<template>
    <AuthenticatedLayout>
        <template #header>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Управление пользователями
                </h2>
        </template>
        <div class="container  px-4 py-4 mx-auto overflow-x-auto ">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow-sm  bg-gray-100  dark:bg-gray-800 p-4">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 dark:text-gray-300 uppercase  border-b border-gray-200">
                                Имя пользователя
                            </th>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 dark:text-gray-300 uppercase  border-b border-gray-200">
                                Роль
                            </th>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 dark:text-gray-300 uppercase  border-b border-gray-200">
                                Email
                            </th>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 dark:text-gray-300 uppercase  border-b border-gray-200">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in filteredUsers" :key="user.id">
                            <td class="px-5 py-5 text-sm  border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full"
                                            src="https://api.dicebear.com/9.x/adventurer/svg?seed=Avery"
                                            alt="profile pic">
                                    </div>

                                    <div class="ml-3">
                                        <p class="text-gray-900 dark:text-gray-200  whitespace-nowrap">
                                            {{ user.name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm  border-b border-gray-200">
                                <p class="text-gray-900 dark:text-gray-200  whitespace-nowrap">
                                    {{
                                        user.roles[0]?.name === 'client' ? 'Клиент' :
                                            user.roles[0]?.name === 'master' ? 'Мастер' :
                                                user.roles[0]?.name === 'admin' ? 'Администратор' :
                                                    user.roles[0]?.name
                                    }}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm  border-b border-gray-200">
                                <p class="text-gray-900 dark:text-gray-200  whitespace-nowrap">
                                    {{ user.email }}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm  border-b border-gray-200">
                                <PrimaryButton @click="openModal(user.id, user.name)" class="btn-primary">
                                    <Icon icon="carbon:edit" class="h-6 w-6" />
                                </PrimaryButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex flex-col items-center px-5 py-5  xs:flex-row xs:justify-between">
                    <span class="text-xs text-gray-900 dark:text-gray-300  xs:text-sm">Showing 1 to 4 of 50
                        Entries</span>

                    <div class="inline-flex gap-4 mt-2 xs:mt-0">
                        <PrimaryButton
                            class="px-4 py-2 text-sm font-semibold text-gray-800 dark:text-gray-200  bg-gray-300 rounded-l hover:bg-gray-400">
                            <Icon icon="carbon:chevron-left" class="w-6 h-6" />
                        </PrimaryButton>
                        <PrimaryButton
                            class="px-4 py-2 text-sm font-semibold text-gray-800 dark:text-gray-200  bg-gray-300 rounded-r hover:bg-gray-400">
                            <Icon icon="carbon:chevron-right" class="w-6 h-6" />
                        </PrimaryButton>

                    </div>
                </div>
            </div>
        </div>
        <!-- <button @click="openModal" class="btn-primary">Добавить пользователя</button> -->
        <Modal :show="showModal" maxWidth="lg" closeable @close="closeModal">
            <template v-slot>
                <div class="p-5">
                    <h2 class="text-xl font-bold text-gray-600 dark:text-gray-200 mb-10 text-center">Обновить роль для
                        {{ currentUserName }} </h2>
                    <form @submit.prevent="updateRole(currentUserId)" class="text-gray-600">
                        <select v-model="rolesMap[currentUserId]">
                            <option v-for="role in filteredRoles" :key="role" :value="role" class="text-gray-600">
                                {{
                                    role === 'client' ? 'Клиент' :
                                        role === 'master' ? 'Мастер' :
                                            role === 'admin' ? 'Администратор' : role
                                }}
                            </option>
                        </select>
                        <div class="flex justify-center gap-4 py-10">
                            <PrimaryButton type="submit" class="">
                                Обновить роль
                            </PrimaryButton>
                            <SecondaryButton @click="closeModal" type="button" class="btn-secondary">
                                Отмена
                            </SecondaryButton>
                        </div>
                    </form>
                </div>
            </template>
        </Modal>
    </AuthenticatedLayout>
</template>

<script setup>
import { reactive, computed, ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from "@/Components/Button/Primary.vue";
import SecondaryButton from "@/Components/Button/Secondary.vue";
import Modal from '@/Components/Modal.vue';
import { Icon } from "@iconify/vue";



const showModal = ref(false); // Управляет состоянием показа модального окна
const currentUserId = ref(null); // ID текущего клиента, роль которого редактируется
const currentUserName = ref(''); // Имя текущего клиента

// Функция для открытия модального окна и установки ID клиента
const openModal = (id, userName) => {
    currentUserId.value = id; // Устанавливаем ID текущего клиента
    currentUserName.value = userName; // Устанавливаем имя клиента
    showModal.value = true;   // Открываем модальное окно
};

// Закрытие модального окна
const closeModal = () => {
    showModal.value = false;
    currentUserId.value = null; // Сбрасываем текущий ID
};

// Получение данных из props
const props = defineProps({
    users: Array,
    roles: Array,
});

// Создаем объект для отслеживания ролей пользователей
const rolesMap = reactive(
    props.users.reduce((map, user) => {
        map[user.id] = user.roles[0]?.name || ''; // Инициализация текущей роли
        return map;
    }, {})
);

// Метод для обновления роли пользователя
const updateRole = (userId) => {
    const role = rolesMap[userId]; // Получаем выбранную роль

    router.post(`/admin/users/${userId}/update-role`, { role }, {
        onSuccess: () => {
            showModal.value = false;
            alert('Роль успешно обновлена!');
        },
        onError: (errors) => {
            console.error(errors);
            alert('Ошибка при обновлении роли.');
        },
    });
};

// Отфильтрованный список пользователей
const filteredUsers = computed(() =>
    props.users.filter(user => {
        const role = user.roles[0]?.name;
        return role === 'client' || role === 'master';
    })
);


const filteredRoles = computed(() => props.roles.filter(role => role !== 'admin'));
</script>

<style scoped>
th,
td {
    padding: 10px;
}

option {
    color: black;
}

select {
    width: 100%;
}
</style>
