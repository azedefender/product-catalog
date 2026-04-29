<template>
  <div class="bg-white p-6 shadow rounded max-w-xl mx-auto">
    <h1 class="text-3xl font-bold">{{ product.name }}</h1>
    <p class="text-gray-500">{{ product.category?.name }}</p>
    <p class="text-2xl font-semibold my-2">{{ product.price }} ₽</p>
    <p class="text-gray-700">{{ product.description }}</p>
    <a href="/" class="mt-4 inline-block text-blue-600 hover:underline">← Назад к каталогу</a>
  </div>
</template>

<script setup>
defineProps({
  product: Object
})
</script>