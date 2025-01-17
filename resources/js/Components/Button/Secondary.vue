<template>
    <button class="btn btn-secondary">
        <slot />
    </button>
</template>

<script setup>

</script>

<style scoped>
.btn-secondary {
    @apply py-2 px-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none transition duration-300 ease-in-out
}
</style>
