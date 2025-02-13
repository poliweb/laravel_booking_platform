<template>
    <button class="btn-primary">
        <slot />
    </button>
</template>

<script setup></script>

<style scoped>
@reference "../../../css/app.css";

.btn-primary {
    @apply bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none transition duration-300 ease-in-out;
}
</style>
