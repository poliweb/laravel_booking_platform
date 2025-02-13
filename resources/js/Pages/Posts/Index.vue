<template>
    <Head title="Список постов" />
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <Link v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" :href="route('posts.create')"
                class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 inline-flex items-center mb-8">
            <ButtonSecondary class="inline-flex gap-2 items-center">
                Создать пост
                <Icon icon="carbon:add-large" class="w-6 h-6" />
            </ButtonSecondary>
            </Link>
            <!-- <h1 class="text-2xl font-bold mb-4">Список постов</h1> -->
            <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
                <h1 class="sm:w-2/5 text-gray-900 dark:text-gray-200 font-medium title-font text-2xl mb-2 sm:mb-0">
                    Список постов
                </h1>
                <p class="sm:w-3/5 dark:text-gray-400 leading-relaxed text-base sm:pl-10 pl-0">Street art subway tile
                    salvia four dollar
                    toast bitters selfies quinoa yuccie synth meditation iPhone intelligentsia prism tofu. Viral
                    gochujang bitters dreamcatcher.</p>
            </div>

            <div v-if="posts && posts.data && posts.data.length === 0">
                <p>Постов пока нет.</p>
            </div>
            <div v-else class="flex flex-wrap -m-4">
                <div v-for="post in posts.data" :key="post.id" class="p-4 md:w-1/3">
                    <div
                        class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden img-efects">
                        <div class="overflow-hidden">
                            <Link :href="route('posts.show', post.id)">
                            <img v-if="post?.image_url"
                                class="lg:h-48 md:h-36 w-full object-cover object-center transition duration-700 ease-in-out"
                                :src="post.image_url" :alt="post.title">
                            <img v-else src="https://placeholder.pics/svg/600x400" :alt="post.title"
                                class="lg:h-48 md:h-36 w-full object-cover object-center transition duration-700 ease-in-out">
                            </Link>
                        </div>
                        <div class="p-6">
                            <h2
                                class="tracking-widest text-sm title-font font-medium text-gray-400 dark:text-gray-200 mb-1">
                                {{ formatPrice(post.price) }} <span>₸</span>
                            </h2>
                            <h1
                                class="title-font text-xl font-medium text-gray-900 dark:text-gray-200 hover:text-pink-500  mb-3 transition duration-700 ease-in-out">
                                <Link :href="route('posts.show', post.id)">
                                {{ post.title }}
                                </Link>
                            </h1>
                            <p class="leading-relaxed mb-3 line-clamp-3 dark:text-gray-400">{{ post.description }}</p>
                            <div class="flex items-center flex-wrap ">
                                <Link :href="route('posts.show', post.id)"
                                    class="text-pink-500 inline-flex items-center gap-2 transition-all duration-300 hover:gap-4 md:mb-2 lg:mb-0 ">
                                Подробнее
                                <Icon icon="carbon:arrow-right" class="w-6 h-6" />
                                </Link>

                                <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" class="flex items-center ml-auto">
                                    <span
                                        class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                        <Link :href="route('admin.posts.edit', { post: post.id })">
                                        <ButtonSecondary>
                                            <Icon icon="carbon:settings-edit" class="w-6 h-6" />
                                        </ButtonSecondary>
                                        </Link>
                                    </span>
                                    <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                        <ButtonSecondary @click="deletePost(post.id)">
                                            <Icon icon="carbon:trash-can" class="w-6 h-6" />
                                        </ButtonSecondary>
                                    </span>
                                </div>

                                <ModalAlert :show="showModalAlert" maxWidth="lg" closeable @close="closeModal">
                                    <template v-slot>
                                        <div class="p-8">
                                            <div class="flex flex-row items-center justify-between">
                                                <div class="text-gray-600 dark:text-gray-200">
                                                    Пост удалён!
                                                </div>
                                                <div class="">
                                                    <button @click="closeModal">
                                                        <Icon icon="carbon:close-outline" class="w-6 h-6 text-gray-600 dark:text-gray-200" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                </ModalAlert>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script setup>
import { computed, ref } from 'vue'
import { Icon } from "@iconify/vue";
import { usePage, Link, Head, router } from "@inertiajs/vue3";
import DefaultLayout from '@/Layouts/DefoultLayout.vue';
import ButtonSecondary from '@/Components/Button/Secondary.vue';
import ModalAlert from '@/Components/Modal.vue'

const posts = usePage().props.posts;

const { flash } = usePage().props;

defineOptions({ layout: DefaultLayout })

const showModalAlert = ref(false);
// Закрытие модального окна
const closeModal = () => {
    showModalAlert.value = false;
};


function deletePost(postId) {
    if (confirm('Вы уверены, что хотите удалить пост?')) {
        router.delete(route('posts.destroy', { post: postId }), {
            onSuccess: () => {
                // Удалите пост из массива posts
                const index = posts.data.findIndex(post => post.id === postId);
                if (index !== -1) {
                    posts.data.splice(index, 1);
                    //
                    showModalAlert.value = true;
                    setTimeout(() => {
                        showModalAlert.value = false;
                    }, 3000);
                }
            },
        });
    }
}



// Вычисляемое свойство для форматирования цен всех постов
const formatPrice = (price) => {
    return new Intl.NumberFormat('ru-RU', {
        style: 'decimal',  // Числовой стиль
        useGrouping: true, // Включить группировку
    }).format(price)
}
</script>

<style scoped>
.img-efects:hover img {
    transform: scale(1.5);
}
</style>
