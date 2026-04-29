<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl">Управление товарами</h2>
      <a href="/admin/products/create" class="bg-green-600 text-white px-4 py-2 rounded">Добавить товар</a>
    </div>
    <div class="bg-white shadow rounded overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-3 text-left">Название</th>
            <th class="p-3 text-left">Категория</th>
            <th class="p-3 text-left">Цена</th>
            <th class="p-3">Действия</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id" class="border-t">
            <td class="p-3">{{ product.name }}</td>
            <td class="p-3">{{ product.category?.name }}</td>
            <td class="p-3">{{ product.price }} ₽</td>
            <td class="p-3 text-center space-x-2">
              <a :href="`/admin/products/${product.id}/edit`" class="text-blue-600 hover:underline">Редактировать</a>
              <button @click="confirmDelete(product.id)" class="text-red-600 hover:underline">Удалить</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- пагинация аналогично публичной -->
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useProductApi } from '@/Composables/useProductApi'
import { router } from '@inertiajs/vue3'

const { getProducts, deleteProduct } = useProductApi()
const products = ref([])

const fetch = async () => {
  const res = await getProducts()
  products.value = res.data
}

const confirmDelete = async (id) => {
  if (confirm('Удалить товар?')) {
    await deleteProduct(id)
    await fetch()
  }
}

onMounted(fetch)
</script>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
export default { layout: AdminLayout }
</script>