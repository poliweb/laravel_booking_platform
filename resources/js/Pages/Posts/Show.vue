<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-col">
            <div class="lg:w-4/6 mx-auto">
                <div class="rounded-lg h-64 overflow-hidden">
                    <img v-if="post?.image_url" class="object-cover object-center h-full w-full"
                    :src="post.image_url" :alt="post.title">
                    <img v-else class="object-cover object-center h-full w-full"
                        src="https://placeholder.pics/svg/1200x500" :alt="post.title">

                </div>
                <div class="flex flex-col sm:flex-row mt-10">
                    <div class="sm:w-1/3 sm:pr-8 sm:py-8">

                        <div class="flex flex-col items-center justify-center">
                            <h2 class="font-medium title-font mt-4 text-center text-gray-900 dark:text-gray-300 text-3xl">{{ post.title }}</h2>
                            <div class="w-12 h-1 bg-pink-500 rounded mt-2 mb-4"></div>
                            <p class="text-base text-center  dark:text-gray-400">
                                {{ post.description }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                        <p class="leading-relaxed dark:text-gray-400 text-lg mb-4">
                            {{ post.content }}
                        </p>
                        <Link :href="route('posts.index')">
                        <ButtonSecondary class="text-indigo-500 inline-flex gap-2 items-center">
                            <Icon icon="carbon:arrow-left" class="w-6 h-6"/>
                            Назад
                        </ButtonSecondary>
                    </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import DefaultLayout from '@/Layouts/DefoultLayout.vue';
import ButtonSecondary from '@/Components/Button/Secondary.vue'
import { Link } from '@inertiajs/vue3'
import { Icon } from "@iconify/vue";

defineOptions({ layout: DefaultLayout })

defineProps({
  post: Object
});

const goBack = () => {
  window.history.back();
};
</script>

<style scoped></style>
