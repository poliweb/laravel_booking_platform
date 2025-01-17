<template>
    <button class="btn btn-primary">
        <slot />
    </button>
</template>

<script setup>

</script>

<style scoped>
.btn-primary {
    @apply py-2 px-4 bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none transition duration-300 ease-in-out
}
</style>
