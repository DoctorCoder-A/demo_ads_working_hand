<script setup>
import Header from './components/Header.vue'
import { ref } from 'vue'
const count = ref(0)
</script>

<template>
    <Header />
    <main class="container-sm">
        <RouterView />
    </main>
</template>

<style scoped>
button {
    font-weight: bold;
}
</style>
