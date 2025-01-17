<template>
    <div>

        <div class="container px-5 py-24 mx-auto text-gray-600 dark:text-gray-400">
            <h1>Редактировать пост</h1>
            <form @submit.prevent="submit">
                <div class="flex flex-col mb-8">
                    <label for="title">Заголовок</label>
                    <input type="text" id="title" v-model="form.title" class="caret-pink-800" />
                    <span v-if="form.errors.title">{{ form.errors.title }}</span>
                </div>
                <div class="flex flex-col mb-8">
                    <label for="description">Описание</label>
                    <textarea id="description" v-model="form.description" class="caret-pink-800"></textarea>
                    <span v-if="form.errors.description">{{ form.errors.description }}</span>
                </div>
                <div class="flex flex-col mb-8">
                    <label for="content">Контент</label>
                    <textarea id="content" v-model="form.content" class="caret-pink-800"></textarea>
                    <span v-if="form.errors.content">{{ form.errors.content }}</span>
                </div>
                <div class="flex flex-col mb-8">
                    <label for="image_url">Фото</label>
                    <input type="text" id="image_url" v-model="form.image_url" class="caret-pink-800" />
                    <span v-if="form.errors.image_url">{{ form.errors.image_url }}</span>
                </div>
                <div class="flex flex-col mb-8">
                    <label for="price">Price</label>
                    <input type="number" id="price" v-model="form.price" step="0.01" class="caret-pink-800" />
                    <span v-if="form.errors.price">{{ form.errors.price }}</span>
                </div>
                <PrimaryButton type="submit" :disabled="form.processing">Сохранить</PrimaryButton>
                <!-- <PrimaryButton type="submit">Добавить запись</PrimaryButton> -->
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefoultLayout.vue';
import PrimaryButton from "@/Components/Button/Primary.vue";


defineOptions({ layout: DefaultLayout })

const props = defineProps({
    post: Object,
});

// Форма для обновления поста
const form = useForm({
    title: props.post.title,
    description: props.post.description,
    image_url: props.post.image_url,
    content: props.post.content,
    price: props.post.price,
});

// Обработчик отправки формы
const submit = () => {
    form.put(route('posts.update', props.post.id), {
        onSuccess: () => {
            console.log('Post updated successfully');
        },
        onError: (errors) => {
            console.error('Validation errors:', errors);
        },
    });
};
</script>
