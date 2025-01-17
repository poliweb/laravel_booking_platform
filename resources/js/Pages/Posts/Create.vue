<template>
    <div class="container px-5 py-24 mx-auto text-gray-600 dark:text-gray-400">
      <h1>Create a New Post</h1>
      <form @submit.prevent="submit">
        <div class="flex flex-col mb-8">
          <label for="title">Заголовок</label>
          <input type="text" id="title" v-model="form.title" class="caret-pink-800"/>
        </div>
        <div class="flex flex-col mb-8">
          <label for="description">Описание</label>
          <textarea id="description" v-model="form.description" class="caret-pink-800"></textarea>
        </div>
        <div class="flex flex-col mb-8">
          <label for="content">Контент</label>
          <textarea id="content" v-model="form.content" class="caret-pink-800"></textarea>
        </div>
        <div class="flex flex-col mb-8">
          <label for="image_url">Фото</label>
          <input type="text" id="image_url" v-model="form.image_url" class="caret-pink-800"/>
        </div>
        <div class="flex flex-col mb-8">
          <label for="price">Price</label>
          <input type="number" id="price" v-model="form.price" step="0.01" class="caret-pink-800" />
        </div>
        <PrimaryButton type="submit">Добавить запись</PrimaryButton>
      </form>
    </div>
  </template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import DefaultLayout from '@/Layouts/DefoultLayout.vue';
import PrimaryButton from "@/Components/Button/Primary.vue";

// Устанавливаем layout для компонента
defineOptions({ layout: DefaultLayout });

// Используем Inertia для управления формой
const form = useForm({
  title: "",
  description: "",
  content: "",
  image_url: "",
  price: "",
});

// Функция для отправки формы
const submit = () => {
  form.post(route("posts.store"));
};
</script>
