<template>
    <Head title="Home" />
    <div class="container px-5 py-24 mx-auto">
        <h1 v-if="user" class="text-center text-5xl font-bold text-pink-500">Home | {{ user?.name }}</h1>
        <h1 v-else class="text-center text-5xl font-bold text-pink-500">Home</h1>
    </div>
    <div class="container px-5 py-24 mx-auto">
        <List />
    </div>
</template>

<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import DefaultLayout from '@/Layouts/DefoultLayout.vue';
import List from '@/Components/List.vue';

const page = usePage();

const user = computed(() => page.props.auth.user);

defineOptions({ layout: DefaultLayout })

</script>

<style scoped>

</style>
