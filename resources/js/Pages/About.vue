<template>

    <Head title="About" />
    <div class="container px-5 py-24 mx-auto min-h-screen">
        <h1 v-if="user" class="text-5xl font-bold text-pink-500 text-center">
            About | {{ user?.name }} статус:
            {{
                user?.role === 'client' ? 'Клиент' :
                    user?.role === 'master' ? 'Мастер' :
                        user?.role === 'admin' ? 'Администратор' : user?.role
            }}
        </h1>
        <h1 v-else class="text-5xl font-bold text-pink-500 text-center">
            About
        </h1>
        <div class="flex flex-wrap justify-center gap-6 my-6">
            <PrimaryButton>Primary</PrimaryButton>
            <SecondaryButton>Secondary</SecondaryButton>
        </div>
        <Form />
    </div>
</template>

<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefoultLayout.vue";
import PrimaryButton from "@/Components/Button/Primary.vue";
import SecondaryButton from "@/Components/Button/Secondary.vue";
import Form from "@/Components/Form.vue";

const page = usePage();

const user = computed(() => page.props.auth.user);

defineOptions({ layout: DefaultLayout });
</script>

<style scoped></style>
