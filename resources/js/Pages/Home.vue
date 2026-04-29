<template>
  <div>
    <h2 class="text-2xl mb-4">Каталог товаров</h2>
    
    <select v-model="selectedCategory" @change="fetchProducts" class="mb-4 p-2 border rounded">
      <option value="">Все категории</option>
      <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
    </select>

    <div class="grid gap-4 md:grid-cols-3">
      <div v-for="product in products" :key="product.id" class="bg-white p-4 shadow rounded">
        <a :href="`/product/${product.id}`" class="text-lg font-semibold">{{ product.name }}</a>
        <p class="text-gray-600">{{ product.category?.name }}</p>
        <p class="font-bold mt-2">{{ product.price }} ₽</p>
        <p class="text-sm text-gray-500">{{ product.description?.substring(0, 80) }}...</p>
      </div>
    </div>

    <div v-if="links.length > 0" class="mt-4 flex justify-center space-x-2">
      <button v-for="link in links" :key="link.label"
        :disabled="!link.url" @click="goToPage(link.url)"
        class="px-3 py-1 border rounded" 
        :class="{'bg-blue-500 text-white': link.active}">
        {{ link.label }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const products = ref([])
const categories = ref([])
const selectedCategory = ref('')
const links = ref([])

const fetchProducts = async (url = null) => {
  try {
    const params = url ? {} : { category_id: selectedCategory.value || undefined }
    const response = url ? await axios.get(url) : await axios.get('/api/products', { params })
    
    // Laravel Resource Collection возвращает { data: [...], links: [...], meta: ... }
    if (response.data) {
      products.value = response.data.data || response.data
      links.value = response.data.links || []
    }
  } catch (error) {
    console.error('Ошибка загрузки товаров:', error)
    products.value = []
    links.value = []
  }
}

const goToPage = (url) => {
  if (url) fetchProducts(url)
}

const fetchCategories = async () => {
  try {
    const { data } = await axios.get('/api/categories')
    // API ресурс категорий возвращает { data: [...] }
    categories.value = data.data || data
  } catch (error) {
    console.error('Ошибка загрузки категорий:', error)
  }
}

onMounted(() => {
  fetchCategories()
  fetchProducts()
})
</script>