<script setup>
import { reactive } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import PrimaryButton from "@/Components/Button/Primary.vue";

const form = reactive({
    first_name: null,
    last_name: null,
    email: null,
})

const errors = reactive({  })

function submit() {
    router.post('/articles', form, {
        onSuccess: () => {
            alert('Данные успешно сохранены!')
            form.first_name = null
            form.last_name = null
            form.email = null
        },
        onError: (error) => {
            Object.assign(errors, error)
        },

    })
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="flex flex-col gap-8 w-full max-w-[500px] mx-auto">
            <div class="flex flex-col gap-4">
                <label for="first_name" class="text-gray-600 dark:text-gray-100">First name:</label>
                <input id="first_name" v-model="form.first_name" />
                <span v-if="errors.first_name" class="text-red-500">{{ errors.first_name[0] }}</span>
            </div>
            <div class="flex flex-col gap-4">
                <label for="last_name" class="text-gray-600 dark:text-gray-100">Last name:</label>
                <input id="last_name" v-model="form.last_name" />
                <span v-if="errors.last_name" class="text-red-500">{{ errors.last_name[0] }}</span>
            </div>
            <div class="flex flex-col gap-4">
                <label for="email" class="text-gray-600 dark:text-gray-100">Email:</label>
                <input id="email" v-model="form.email" />
                <span v-if="errors.email" class="text-red-500">{{ errors.email[0] }}</span>
            </div>
            <PrimaryButton type="submit" class="">Submit</PrimaryButton>
        </div>
    </form>
</template>

